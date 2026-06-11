<?php

namespace App\Http\Controllers;

use App\Utility\PayfastUtility;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Address;
use App\Models\Carrier;
use App\Models\CombinedOrder;
use App\Models\Product;
use App\Models\PickupPoint;
use App\Utility\PayhereUtility;
use App\Utility\NotificationUtility;
use Session;
use Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        //
    }

    //check the selected payment gateway and redirect to that controller accordingly
    public function checkout(Request $request)
    {
        // Minimum order amount check
        if(get_setting('minimum_order_amount_check') == 1){
            $subtotal = 0;
            foreach (Cart::where('user_id', Auth::user()->id)->get() as $key => $cartItem){ 
                $product = Product::find($cartItem['product_id']);
                $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];
            }
            if ($subtotal < get_setting('minimum_order_amount')) {
                flash(translate('You order amount is less then the minimum order amount'))->warning();
                return redirect()->route('home');
            }
        }
        
        if ($request->payment_option != null) {
            \Log::info('Checkout called', ['payment_option' => $request->payment_option]);
            
            (new OrderController)->store($request);

            $request->session()->put('payment_type', 'cart_payment');
            
            $combined_order_id = $request->session()->get('combined_order_id');
            \Log::info('Combined order ID after store: ' . $combined_order_id);
            
            if ($combined_order_id != null) {
                // If block for Online payment, wallet and cash on delivery. Else block for Offline payment
                $decorator = __NAMESPACE__ . '\\Payment\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $request->payment_option))) . "Controller";
                \Log::info('Payment decorator: ' . $decorator);
                
                if (class_exists($decorator)) {
                    return (new $decorator)->pay($request);
                }
                else {
                    \Log::error('Payment controller not found: ' . $decorator);
                    $combined_order = CombinedOrder::findOrFail($combined_order_id);
                    $manual_payment_data = [
                        'name'   => $request->payment_option,
                        'amount' => $combined_order->grand_total,
                        'trx_id' => $request->trx_id,
                        'photo'  => $request->photo,
                    ];
                    foreach ($combined_order->orders as $order) {
                        $order->manual_payment = 1;
                        $order->manual_payment_data = json_encode($manual_payment_data);
                        $order->save();
                    }
                    flash(translate('Your order has been placed successfully. Please submit payment information from purchase history'))->success();
                    return redirect()->route('order_confirmed');
                }
            } else {
                flash(translate('Order creation failed. Please try again.'))->error();
                return redirect()->route('checkout.shipping_info');
            }
        } else {
            flash(translate('Select Payment Option.'))->warning();
            return back();
        }
    }

    //redirects to this method after a successful checkout
    public function checkout_done($combined_order_id, $payment)
    {
        $combined_order = CombinedOrder::findOrFail($combined_order_id);

        foreach ($combined_order->orders as $key => $order) {
            $order = Order::findOrFail($order->id);
            $order->payment_status = 'paid';
            $order->payment_details = $payment;
            $order->save();

            calculateCommissionAffilationClubPoint($order);
        }
        Session::put('combined_order_id', $combined_order_id);
        return redirect()->route('order_confirmed');
    }

    public function get_shipping_info(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        if ($carts->count() > 0) {
            $shipping_info = Address::where('user_id', Auth::user()->id)->get();
            return view('frontend.shipping_info', ['shipping_info' => $shipping_info, 'carts' => $carts]);
        }
        flash(translate('Your cart is empty'))->warning();
        return redirect()->route('home');
    }

    public function store_shipping_info(Request $request)
    {
        if (Auth::user()->addresses == null || Auth::user()->addresses->isEmpty()) {
            flash(translate('Please add shipping address'))->warning();
            return back();
        }
        if ($request->address_id == null) {
            flash(translate('Please select shipping address'))->warning();
            return back();
        }

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($carts as $cartItem) {
            $cartItem['address_id'] = $request->address_id;
            $cartItem->save();
        }

        return redirect()->route('checkout.payment_info');
    }

    public function store_delivery_info(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();

        if ($carts->isEmpty()) {
            flash(translate('Your cart is empty'))->warning();
            return redirect()->route('home');
        }

        // Handle address_id if submitted from shipping_info
        if ($request->has('address_id')) {
            foreach ($carts as $cartItem) {
                $cartItem->address_id = $request->address_id;
                $cartItem->save();
            }
        }

        // Handle shipping details if submitted from delivery_info
        foreach ($carts as $key => $cartItem) {
            $product = Product::find($cartItem->product_id);
            $seller_id = $product->user_id;

            if ($request->has('shipping_type_' . $seller_id)) {
                $cartItem['shipping_type'] = $request['shipping_type_' . $seller_id];
            }
            if ($request->has('pickup_point_id_' . $seller_id)) {
                $cartItem['pickup_point_id'] = $request['pickup_point_id_' . $seller_id];
            }
            if ($request->has('carrier_id_' . $seller_id)) {
                $cartItem['carrier_id'] = $request['carrier_id_' . $seller_id];
            }
            if ($request->has('shipping_cost_' . $seller_id)) {
                $cartItem['shipping_cost'] = $request['shipping_cost_' . $seller_id];
            }
            $cartItem->save();
        }

        return redirect()->route('checkout.payment_info');
    }

    public function get_payment_info()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();

        if ($carts->isEmpty()) {
            flash(translate('Your cart is empty'))->warning();
            return redirect()->route('home');
        }
        $shipping_info = Address::find($carts[0]->address_id);
        $total = 0;
        $customer_package = Auth::user()->customer_package;
        return view('frontend.payment_select', compact('carts', 'shipping_info', 'total', 'customer_package'));
    }

    public function get_pick_up_points(Request $request)
    {
        $pick_up_points = PickupPoint::all();
        return view('frontend.partials.pick_up_points', compact('pick_up_points'));
    }

    public function order_confirmed()
    {
        return view('frontend.order_confirmed');
    }

    public function wallet_payment_done($combined_order_id, $payment)
    {
        $combined_order = CombinedOrder::findOrFail($combined_order_id);

        foreach ($combined_order->orders as $key => $order) {
            $order = Order::findOrFail($order->id);
            $order->payment_status = 'paid';
            $order->payment_details = $payment;
            $order->save();
        }
        Session::put('combined_order_id', $combined_order_id);
        return redirect()->route('order_confirmed');
    }
}