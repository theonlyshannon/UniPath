<!-- resources/views/pages/app/transaction/checkout.blade.php -->

<x-layouts.app title="Checkout">
    <section class="page-header">
        <div class="container">
            <div class="page-header__content">
                <ul class="eduhive-breadcrumb list-unstyled">
                    <li><span class="eduhive-breadcrumb__icon"><i class="icon-home"></i></span><a href="{{ route('app.dashboard') }}">Home</a></li>
                    <li><span>Checkout</span></li>
                </ul>
                <h2 class="page-header__title">Checkout</h2>
            </div>
        </div>
        <!-- Include shapes or additional elements if necessary -->
    </section>

    <section class="checkout-page section-space-bottom">
        <div class="container">
            <div class="row gutter-y-40">
                <!-- You can include billing address or user information here if needed -->
                <!-- For now, we will leave this section empty -->
                <div class="col-xl-6 col-lg-7">
                    <div class="checkout-page__billing-address">
                        <!-- Billing Address Section (Optional) -->
                    </div>
                </div>
                <!-- Optionally include additional content here -->
                <div class="col-xl-6 col-lg-5">
                    <!-- Additional Content (Optional) -->
                </div>
            </div>

            <div class="checkout-page__your-order">
                <div class="row gutter-y-40">
                    <div class="col-xl-6 col-lg-6">
                        <h2 class="checkout-page_your-ordertitle checkout-page_title">Your order</h2>
                        <table class="checkout-page__order-table">
                            <thead class="checkout-page__order-table-head">
                                <tr>
                                    <th>Course</th>
                                    <th class="right">Sub total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td class="pro__title">{{ $item->course->title }}</td>
                                        <td class="pro__price">Rp{{ number_format($item->course->price * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="pro__title">Subtotal</td>
                                    <td class="pro__price">Rp{{ number_format($totalPrice, 0, ',', '.') }}</td>
                                </tr>
                                <!-- If you have shipping or tax, you can include them here -->
                                <tr>
                                    <td class="pro__title">Tax</td>
                                    <td class="pro__price">Rp0</td>
                                </tr>
                                <tr>
                                    <td class="pro_title pro_title--total">Total</td>
                                    <td class="pro_price pro_price--total">Rp{{ number_format($totalPrice, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout-page__payment-wrapper">
                            <div class="checkout-page__payment">
                                <div class="checkout-page_paymentitem checkout-pagepayment_item--active">
                                    <h3 class="checkout-page_payment_title">Midtrans Payment Gateway</h3>
                                    <div class="checkout-page_payment_content" style="display: none;">
                                        <p>You will be redirected to the Midtrans payment page to complete your purchase.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout-page_payment_button">
                                <form action="{{ route('app.transaction.processCheckout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="eduhive-btn eduhive-btn--normal">
                                        <span>Place your order</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>