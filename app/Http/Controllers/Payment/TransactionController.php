<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Str;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Cart;

class TransactionController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('course')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('app.cart.index')->with('message', 'Keranjang Anda kosong.');
        }

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->course->price * $item->quantity;
        });

        return view('pages.app.transaction.checkout', compact('cartItems', 'totalPrice'));
    }

    public function processCheckout(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('course')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('app.cart.index')->with('message', 'Keranjang Anda kosong.');
        }

        $transactionCode = 'TRX-' . strtoupper(Str::random(10));
        $amount = $cartItems->sum(function ($item) {
            return $item->course->price * $item->quantity;
        });

        $transaction = Transaction::create([
            'transaction_code' => $transactionCode,
            'user_id' => $user->id,
            'amount' => $amount,
            'status' => 'pending',
            'transaction_date' => now(),
        ]);

        foreach ($cartItems as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'course_id' => $item->course_id,
                'quantity' => $item->quantity,
                'price' => $item->course->price,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('app.transaction.payment.page', ['transactionCode' => $transactionCode]);
    }

    public function payment($transactionCode)
    {
        $user = Auth::user();
        $transaction = Transaction::where('transaction_code', $transactionCode)
            ->where('user_id', $user->id)
            ->first();

        if (!$transaction) {
            return redirect()->route('app.cart.index')->with('error', 'Transaksi tidak ditemukan.');
        }

        if ($transaction->amount == 0) {
            $transaction->status = 'success';
            $transaction->save();

            return redirect()->route('app.transaction.payment.success', $transactionCode)->with('success', 'Transaksi berhasil tanpa pembayaran.');
        }

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)
            ->with('course')
            ->get();

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->transaction_code,
                'gross_amount' => $transaction->amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ],
            'item_details' => $transactionDetails
                ->map(function ($item) {
                    return [
                        'id' => $item->course->id,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'name' => $item->course->title,
                    ];
                })
                ->toArray(),
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            return view('pages.app.transaction.payment', compact('snapToken', 'transaction'));
        } catch (\Exception $e) {
            return redirect()
                ->route('app.transaction.error')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success($transactionCode = null)
    {
        $user = Auth::user();
        $transaction = Transaction::where('transaction_code', $transactionCode)
            ->where('user_id', $user->id)
            ->first();

        if (!$transaction) {
            return redirect()->route('app.dashboard')->with('error', 'Transaksi tidak ditemukan.');
        }

        return view('pages.app.transaction.success', compact('transaction'));
    }

    public function error()
    {
        return view('pages.app.transaction.error');
    }

    public function receiveNotification(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $notification = new Notification();

        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;

        $transaction = Transaction::where('transaction_code', $orderId)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $transaction->status = 'paid';
        } elseif ($transactionStatus == 'pending') {
            $transaction->status = 'pending';
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'cancel' || $transactionStatus == 'expire') {
            $transaction->status = 'failed';
        }

        $transaction->save();

        return response()->json(['message' => 'Notifikasi diproses']);
    }
}
