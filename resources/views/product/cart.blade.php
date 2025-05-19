@extends('layouts.master')

@section('title')
    Cart
@endsection
@section('content')
    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-image">{{ __('string.product image') }}</th>
                                    <th class="product-name">{{ __('string.product name') }}</th>
                                    <th class="product-price">{{ __('string.product price') }}</th>
                                    <th class="product-quantity">{{ __('string.product quantity') }}</th>
                                    <th class="product-total">{{ __('string.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartproducts as $cartproduct)
                                    <tr class="table-body-row">
                                        <td>
                                            <a href="{{ route('delete_cart_product', ['cartid' => $cartproduct->id]) }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <td class="product-image"><img src="{{ asset($cartproduct->product->image_path) }}"
                                                alt=""></td>
                                        <td class="product-name"><a
                                                href="{{ route('single_product', ['productid' => $cartproduct->product->id]) }}">
                                                @if (session('locale') == 'en')
                                                    {{ $cartproduct->product->name }}
                                                @elseif (session('locale') == 'ar')
                                                    {{ $cartproduct->product->name_AR ? $$cartproduct->product->name_AR : $cartproduct->product->name }}
                                                @endif
                                            </a>
                                        </td>
                                        <td class="product-price">${{ $cartproduct->product->price }}</td>
                                        <td class="product-quantity">{{ $cartproduct->quantity }}</td>
                                        <td class="product-total">
                                            ${{ number_format($cartproduct->product->price * $cartproduct->quantity, 2) }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>{{ __('string.total') }}</th>
                                    <th>{{ __('string.price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td><strong>{{ __('string.total') }}</strong></td>
                                    <td>${{ number_format($total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart-buttons">
                            <a href="{{ route('complete_order') }}"
                                class="boxed-btn black">{{ __('string.check out') }}</a>
                            <a href="{{ route('previous_orders') }}"
                                class="boxed-btn black">{{ __('string.previous orders') }}</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->
@endsection
