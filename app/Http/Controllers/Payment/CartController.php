<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Course;

class CartController extends Controller
{
    // Menampilkan keranjang
    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('course')
            ->get();

        // Hitung total harga
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->course->price * $item->quantity;
        });

        return view('pages.app.transaction.cart', compact('cartItems', 'totalPrice'));
    }

    // Menambahkan item ke keranjang
    public function add(Request $request, $courseId)
    {
        $user = Auth::user();

        // Cek apakah course ada
        $course = Course::find($courseId);
        if (!$course) {
            return redirect()->back()->with('error', 'Course tidak ditemukan.');
        }

        // Cek apakah course sudah ada di keranjang
        $existingCart = Cart::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if ($existingCart) {
            return redirect()->back()->with('message', 'Course sudah ada di keranjang Anda.');
        }

        // Tambahkan ke keranjang
        Cart::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'quantity' => 1,
        ]);

        return redirect()->route('app.cart.index')->with('message', 'Course berhasil ditambahkan ke keranjang.');
    }

    // Menghapus item dari keranjang
    public function remove(Request $request, $cartItemId)
    {
        $user = Auth::user();

        $cartItem = Cart::where('id', $cartItemId)
            ->where('user_id', $user->id)
            ->first();

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang Anda.');
        }

        $cartItem->delete();

        return redirect()->route('app.cart.index')->with('message', 'Item berhasil dihapus dari keranjang.');
    }

    // Halaman checkout
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('course')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('app.cart.index')->with('message', 'Keranjang Anda kosong.');
        }

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->course->price * $item->quantity;
        });

        return view('pages.app.transaction.checkout', compact('cartItems', 'totalPrice'));
    }

    // Memproses checkout dan mengintegrasikan dengan Midtrans
    public function processCheckout(Request $request)
    {
        // Proses ini akan ditangani di TransactionController
        return redirect()->route('payment.page', ['transactionCode' => 'SOME_TRANSACTION_CODE']);
    }
}
