<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiResource;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index($status)
    {
        $data = Transaksi::join('products', 'products.id', '=', 'transaksis.product_id')
            ->join('gambars', 'gambars.id', '=', 'products.gambar_id')
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get(['transaksis.*', 'products.product', 'gambars.path']);
        return new TransaksiResource(true, 'List data konten', $data);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'qty'    => 'required|max:1',
            'id'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::whereId($request->id)->first();

        if ($product->stok < $request->qty) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mendapatkan data'
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
                    'name' => $product->product
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

        $payment = new Transaksi();
        $payment->order_id = $params['transaction_details']['order_id'];
        $payment->status = 'pending';
        $payment->harga = $product->harga;
        $payment->user_id = auth()->user()->id;
        $payment->product_id = $request->id;
        $payment->checkout_link = $response->redirect_url;
        $payment->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengisi database',
            'data' => $payment
        ]);
    }

    public function webhook(Request $request)
    {
        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

        $response = Http::withHeaders([
            'Content-type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->get("https://api.sandbox.midtrans.com/v2/$request->order_id/status");

        $response = json_decode($response->body());

        $payment = Transaksi::where('order_id', $response->order_id)->firstOrFail();

        if ($payment->status == 'settlement' || $payment->status == 'success') {
            return response()->json('Payment has been already processed');
        }

        if ($response->transaction_status == 'success') {
            $payment->status = 'success';
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

        $payment->update();
        return response()->json('success');
    }
}
