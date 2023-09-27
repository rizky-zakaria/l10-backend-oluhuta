<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\ProductKreatif;
use App\Models\TransaksiEkonomiKreatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TransaksiEkonomiKreatifController extends Controller
{
    public function create(Request $request)
    {
        $product = ProductKreatif::whereId($request->id)->first();

        if ($product->stok < $request->qty) {
            return response()->json([
                'status' => false,
                'message' => 'Stok tidak cukup'
            ]);
        }

        $params = array(
            'transaction_details' => array(
                'order_id' => Str::uuid(),
                'gross_amount' => $product->harga
            ),
            'item_details' => array(
                array(
                    'price' => $product->harga,
                    'quantity' => $request->qty,
                    'name' => $product->produk
                )
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ),
            'enabled_payments' => array('credit_card', 'bca_va', 'bni_va', 'bri_va')
        );

        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

        $response = Http::withHeaders([
            'Content-type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

        $response = json_decode($response->body());

        $payment = new TransaksiEkonomiKreatif();
        $payment->order_id = $params['transaction_details']['order_id'];
        $payment->status = 'pending';
        $payment->harga = $product->harga;
        $payment->user_id = auth()->user()->id;
        $payment->product_kreatif_id = $request->id;
        $payment->checkout_link = $response->redirect_url;
        $payment->save();

        return response()->json($response);
    }

    public function webhook(Request $request)
    {
        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

        $response = Http::withHeaders([
            'Content-type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->get("https://api.sandbox.midtrans.com/v2/$request->order_id/status");

        $response = json_decode($response->body());

        $payment = TransaksiEkonomiKreatif::where('order_id', $response->order_id)->firstOrFail();

        if ($payment->status == 'settlement' || $payment->status == 'capture') {
            return response()->json('Payment has been already processed');
        }

        if ($response->transaction_status == 'capture') {
            $payment->status = 'capture';
        } elseif ($response->transaction_status == 'settlement') {
            $payment->status = 'settlement';
        } elseif ($response->transaction_status == 'pending') {
            $payment->status = 'pending';
        } elseif ($response->transaction_status == 'deny') {
            $payment->status = 'deny';
        } elseif ($response->transaction_status == 'expire') {
            $payment->status = 'expire';
        } elseif ($response->transaction_status == 'cancel') {
            $payment->status = 'cancel';
        }

        $payment->save();
        return response()->json('success');
    }
}
