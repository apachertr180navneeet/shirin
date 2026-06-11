<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CheckoutController;
use App\Models\CombinedOrder;
use Illuminate\Http\Request;
use Auth;

class PayumoneyController extends Controller
{
    public function pay(Request $request)
    {
        $combined_order = CombinedOrder::findOrFail(session('combined_order_id'));
        $amount = $combined_order->grand_total;
        $user = Auth::user();

        $txnid = 'TXN_' . uniqid() . '_' . $combined_order->id;
        $productinfo = 'Order Payment';
        $firstname = $user->name;
        $email = $user->email;
        $phone = $user->phone ?? '';

        $merchant_key = env('PAYU_MERCHANT_KEY');
        $salt = env('PAYU_SALT');
        $payu_url = env('PAYU_BASE_URL', 'https://test.payu.in/_payment');

        $hashString = $merchant_key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|||||||||||' . $salt;
        $hash = strtolower(hash('sha512', $hashString));

        return view('frontend.payumoney.pay', compact(
            'merchant_key', 'txnid', 'amount', 'productinfo', 'firstname', 'email', 'phone', 'hash', 'payu_url', 'combined_order'
        ));
    }

    public function success(Request $request)
    {
        $status = $request->status;
        $txnid = $request->txnid;
        $amount = $request->amount;
        $productinfo = $request->productinfo;
        $firstname = $request->firstname;
        $email = $request->email;
        $payu_hash = $request->hash;

        $salt = env('PAYU_SALT');

        $reverseHashString = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . env('PAYU_MERCHANT_KEY');
        $reverseHash = strtolower(hash('sha512', $reverseHashString));

        if ($reverseHash === $payu_hash && $status === 'success') {
            $combined_order_id = session('combined_order_id');
            $combined_order = CombinedOrder::findOrFail($combined_order_id);

            foreach ($combined_order->orders as $order) {
                $order->payment_status = 'paid';
                $order->payment_details = json_encode($request->all());
                $order->save();

                calculateCommissionAffilationClubPoint($order);
            }

            return redirect()->route('order_confirmed');
        }

        flash(translate('Payment failed or hash mismatch.'))->error();
        return redirect()->route('home');
    }

    public function cancel(Request $request)
    {
        flash(translate('Payment cancelled.'))->error();
        return redirect()->route('home');
    }
}
