<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class MyfatoorahController extends Controller
{
    public function callback(Request $request)
    {
        // MyFatoorah payment callback handler
        // TODO: Implement payment verification logic
        
        if (Session::has('payment_type')) {
            if (Session::get('payment_type') == 'cart_payment') {
                return (new CheckoutController)->checkout_done(Session::get('combined_order_id'), $request->all());
            } elseif (Session::get('payment_type') == 'wallet_payment') {
                return (new WalletController)->wallet_payment_done(Session::get('payment_data'), $request->all());
            } elseif (Session::get('payment_type') == 'customer_package_payment') {
                return (new CustomerPackageController)->purchase_payment_done(Session::get('payment_data'), $request->all());
            } elseif (Session::get('payment_type') == 'seller_package_payment') {
                return (new SellerPackageController)->purchase_payment_done(Session::get('payment_data'), $request->all());
            }
        }
        
        return redirect()->route('home');
    }
}
