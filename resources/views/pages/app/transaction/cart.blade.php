<!-- resources/views/pages/app/transaction/cart.blade.php -->

<x-layouts.app title="Keranjang Belanja">
    <section class="page-header">
        <div class="container">
            <div class="page-header__content">
                <ul class="eduhive-breadcrumb list-unstyled">
                    <li><span class="eduhive-breadcrumb__icon"><i class="icon-home"></i></span>Cart</li>
                    <li><span>Course</span></li>
                </ul>
                <h2 class="page-header__title">Unipath Cart</h2>
            </div>
        </div>
        <img src="{{ asset('app/images/shapes/page-header-shape-1.png') }}" alt="shape"
            class="page-header__shape-one">
        <img src="{{ asset('app/images/shapes/page-header-shape-2.png') }}" alt="shape"
            class="page-header__shape-two">
        <div class="page-header__shape-three"></div>
        <div class="page-header__shape-four"></div>
    </section>

    <section class="cart-page section-space2">
        <div class="container">
            <!-- Tampilkan pesan sukses atau error -->
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row gutter-y-50">
                <div class="col-xl-12">
                    @if ($cartItems->isEmpty())
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
                                                        <img src="{{ asset('storage/' . $cartItem->course->thumbnail) }}"
                                                            alt="{{ $cartItem->course->title }}">
                                                    </div>
                                                    <h3 class="cart-page__table__meta__title">
                                                        <a
                                                            href="{{ route('app.course.show', $cartItem->course->slug) }}">{{ $cartItem->course->title }}</a>
                                                    </h3>
                                                </div>
                                            </td>
                                            <td class="cart-page__table__price">
                                                @if ($cartItem->course->price == 0)
                                                    Rp0 (Free Course)
                                                @else
                                                    Rp{{ number_format($cartItem->course->price, 0, ',', '.') }}
                                                @endif
                                            </td>
                                            <td>{{ $cartItem->quantity }}</td>
                                            <td class="cart-page__table__total">
                                                @if ($cartItem->course->price * $cartItem->quantity == 0)
                                                    Rp0 (Free Course)
                                                @else
                                                    Rp{{ number_format($cartItem->course->price * $cartItem->quantity, 0, ',', '.') }}
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('app.cart.remove', $cartItem->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="cart-page__table__remove"><i
                                                            class="icon-close"></i></button>
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
                    @if (!$cartItems->isEmpty())
                        <div class="cart-page__cart-checkout">
                            <ul class="cart-page__cart-total list-unstyled">
                                <li class="cart-page__cart-total__top">
                                    <h3 class="cart-page__cart-total__title">Subtotal</h3>
                                </li>
                                <li class="cart-page__cart-total__amount cart-page__cart-total__amount--1">
                                    <span class="cart-page__cart-total__amount__title">Subtotal</span>
                                    <span class="cart-page__cart-total__amount__text">
                                        @if ($totalPrice == 0)
                                            Rp0 (Free Courses)
                                        @else
                                            Rp{{ number_format($totalPrice, 0, ',', '.') }}
                                        @endif
                                    </span>
                                </li>
                                <li class="cart-page__cart-total__address">
                                    <h4 class="cart-page__cart-total__address__title">Courses Selected</h4>
                                    <ul class="cart-page__cart-total__address__list list-unstyled">
                                        @foreach ($cartItems as $index => $cartItem)
                                            <li class="cart-page__cart-total__address__list__item">{{ $index + 1 }}.
                                                {{ $cartItem->course->title }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                            <div class="cart-page__button">
                                <a href="{{ route('app.transaction.checkout') }}"
                                    class="eduhive-btn eduhive-btn--normal">
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
