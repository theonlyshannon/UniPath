<!-- resources/views/pages/app/transaction/checkout.blade.php -->

<x-layouts.app title="Checkout">
    <section class="checkout-section">
        <div class="container">
            <h1>Checkout</h1>
            <table>
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->course->title }}</td>
                            <td>Rp{{ number_format($item->course->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3>Total: Rp{{ number_format($totalPrice, 0, ',', '.') }}</h3>
            <form action="{{ route('app.transaction.processCheckout') }}" method="POST">
                @csrf
                <button type="submit">Bayar Sekarang</button>
            </form>
        </div>
    </section>
</x-layouts.app>
