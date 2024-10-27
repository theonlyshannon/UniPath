<!-- resources/views/pages/app/transaction/cart.blade.php -->

<x-layouts.app title="Keranjang Belanja">
    <section class="page-header">
        <div class="container">
            <div class="page-header__content">
                <ul class="eduhive-breadcrumb list-unstyled">
                    <li><span class="eduhive-breadcrumb__icon"><i class="icon-home"></i></span><a href="{{ route('app.dashboard') }}">Home</a></li>
                    <li><span>Cart</span></li>
                </ul>
                <h2 class="page-header__title">Cart</h2>
            </div>
        </div>
        <!-- Tambahkan shape jika diperlukan -->
    </section>

    <section class="cart-page section-space2">
        <div class="container">
            <!-- Tampilkan pesan sukses atau error -->
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row gutter-y-50">
                <div class="col-xl-12">
                    @if($cartItems->isEmpty())
                        <p>Keranjang Anda kosong.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table cart-page__table">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Sub Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $cartItem)
                                        <tr>
                                            <td>
                                                <div class="cart-page__table__meta">
                                                    <div class="cart-page__table__meta__img">
                                                        <img src="{{ asset('storage/' . $cartItem->course->thumbnail) }}" alt="{{ $cartItem->course->title }}">
                                                    </div>
                                                    <h3 class="cart-page__table__meta__title">
                                                        <a href="{{ route('app.course.show', $cartItem->course->slug) }}">{{ $cartItem->course->title }}</a>
                                                    </h3>
                                                </div>
                                            </td>
                                            <td class="cart-page__table__price">Rp{{ number_format($cartItem->course->price, 0, ',', '.') }}</td>
                                            <td>{{ $cartItem->quantity }}</td>
                                            <td class="cart-page__table__total">Rp{{ number_format($cartItem->course->price * $cartItem->quantity, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="{{ route('app.cart.remove', $cartItem->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="cart-page__table__remove"><i class="icon-close"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="col-xl-12">
                    @if(!$cartItems->isEmpty())
                        <div class="cart-page__cart-checkout">
                            <ul class="cart-page__cart-total list-unstyled">
                                <li class="cart-page__cart-total__top">
                                    <h3 class="cart-page__cart-total__title">Subtotal</h3>
                                </li>
                                <li class="cart-page__cart-total__amount cart-page__cart-total__amount--1">
                                    <span class="cart-page__cart-total__amount__title">Subtotal</span>
                                    <span class="cart-page__cart-total__amount__text">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                                </li>
                                <li class="cart-page__cart-total__address">
                                    <h4 class="cart-page__cart-total__address__title">Courses Selected</h4>
                                    <ul class="cart-page__cart-total__address__list list-unstyled">
                                        @foreach ($cartItems as $cartItem)
                                            <li class="cart-page__cart-total__address__list__item">{{ $cartItem->course->title }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="cart-page__cart-total__amount cart-page__cart-total__amount--2">
                                    <span>Total</span><span class="cart-page__cart-total__amount__text">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                                </li>
                            </ul>
                            <div class="cart-page__button">
                                <a href="{{ route('app.transaction.checkout') }}" class="eduhive-btn eduhive-btn--normal">
                                    <span>Checkout</span>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
