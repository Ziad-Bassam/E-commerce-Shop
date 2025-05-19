@extends('layouts.master')

@section('title')
    Complete order
@endsection
@section('content')





    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- check out section -->
    <div class="checkout-section mt-4 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            {{ __('string.billing information') }}
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <form action="{{ route('store_order') }}" method="post" id="store_order"
                                                name="store_order">
                                                @csrf()
                                                <p><input type="text" required id="name" name="name"
                                                        placeholder="{{__('string.name')}}"></p>
                                                <p><input type="email" required id="email" name="email"
                                                        placeholder="{{__('string.email')}}"></p>
                                                <p><input type="text" required id="address" name="address"
                                                        placeholder="{{__('string.address')}}"></p>
                                                <p><input type="tel" required id="phone" name="phone"
                                                        placeholder="{{__('string.phone')}}"></p>
                                                <p>
                                                    <textarea name="note" id="note" cols="30" rows="10" placeholder="{{__('string.notes')}}"></textarea>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            {{ __('string.cart details') }}
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-details">
                                            <!-- cart -->
                                            <div class="cart-section mt-2 mb-2">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-12">
                                                            @isset($cartproducts)
                                                                @if ($cartproducts->isNotEmpty())
                                                                    <div class="cart-table-wrap">
                                                                        <table class="cart-table">
                                                                            <thead class="cart-table-head">
                                                                                <tr class="table-head-row">
                                                                                    <th class="product-image">
                                                                                        {{ __('string.product image') }}</th>
                                                                                    <th class="product-name">
                                                                                        {{ __('string.product name') }}</th>
                                                                                    <th class="product-price">
                                                                                        {{ __('string.product price') }}</th>
                                                                                    <th class="product-quantity">
                                                                                        {{ __('string.product quantity') }}</th>
                                                                                    <th class="product-total">
                                                                                        {{ __('string.total') }}</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($cartproducts as $cartproduct)
                                                                                    <tr class="table-body-row">
                                                                                        <td class="product-image"><img
                                                                                                src="{{ asset($cartproduct->product->image_path) }}"
                                                                                                alt=""></td>
                                                                                        <td class="product-name"><a
                                                                                                href="{{ route('single_product', ['productid' => $cartproduct->product->id]) }}">{{ $cartproduct->product->name }}</a>
                                                                                        </td>
                                                                                        <td class="product-price">
                                                                                            ${{ $cartproduct->product->price }}
                                                                                        </td>
                                                                                        <td class="product-quantity">
                                                                                            {{ $cartproduct->quantity }}</td>
                                                                                        <td class="product-total">
                                                                                            ${{ number_format($cartproduct->product->price * $cartproduct->quantity, 2) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @else
                                                                    <p>Your cart is empty.</p>
                                                                @endif
                                                            @endisset
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="total-section">
                                                                <table class="total-table">
                                                                    <thead class="total-table-head">
                                                                        <tr class="table-total-row">
                                                                            <th>{{__('string.total')}}</th>
                                                                            <th>{{__('string.price')}}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="total-data">
                                                                            <td><strong>{{__('string.total')}}: </strong></td>
                                                                            <td>${{ number_format($total ?? 0, 2) }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end cart -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="cart-buttons">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('store_order').submit();"
                            class="boxed-btn">{{__('string.place order')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end check out section -->
@endsection
