<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        if (request('order_id') != '') {
            return $this->createOrder(request('order_id'), request('total'));
        }
        return view('payment_index');
    }

    private function createOrder($id, $total)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        $params = array(
            'transaction_details' => array(
                'order_id' => $id,
                'gross_amount' => $total,
            )
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json([
            'snapToken' => $snapToken
        ], 200);
    }
}
