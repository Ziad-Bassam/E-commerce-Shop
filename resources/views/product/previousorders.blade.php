@extends('layouts.master')

@section('title')
    Previous Orders
@endsection
@section('content')
    <!-- check out section -->
    <div class="checkout-section mt-4 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">

                            @foreach ($orders as $order)
                                <div class="card single-accordion">
                                    <div class="card-header" id="heading{{ $loop->index }}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapse{{ $loop->index }}"
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $loop->index }}">
                                                {{ __('string.order number') }} {{ $loop->iteration }}
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse{{ $loop->index }}" class="collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $loop->index }}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="billing-address-form">
                                                <div class="card p-3 mb-4 shadow-sm">
                                                    <h5 class="mb-3">{{ __('string.order info') }}</h5>
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label for="name"
                                                                class="form-label">{{ __('string.name') }}</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="name" value="{{ $order->name }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="email"
                                                                class="form-label">{{ __('string.email') }}</label>
                                                            <input type="email" readonly class="form-control"
                                                                id="email" value="{{ $order->email }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="address"
                                                                class="form-label">{{ __('string.address') }}</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="address" value="{{ $order->address }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="phone"
                                                                class="form-label">{{ __('string.phone') }}</label>
                                                            <input type="tel" readonly class="form-control"
                                                                id="phone" value="{{ $order->phone }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="created_at"
                                                                class="form-label">{{ __('string.order date') }}</label>
                                                            <input type="text" readonly class="form-control"
                                                                id="created_at"
                                                                value="{{ $order->created_at->format('Y-m-d H:i') }}">
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="note"
                                                                class="form-label">{{ __('string.notes') }}</label>
                                                            <textarea readonly class="form-control" id="note" rows="3">{{ $order->note }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- cart -->
                                                <div class="cart-section mt-4 mb-5">
                                                    <div class="container">
                                                        <div class="row g-4">
                                                            <!-- Order Items -->
                                                            <div class="col-lg-8">
                                                                <div class="card border-0 shadow-sm rounded-4">
                                                                    <div class="card-body">
                                                                        <div class="d-flex align-items-center mb-3">
                                                                            <i
                                                                                class="bi bi-box-seam fs-4 text-primary me-2"></i>
                                                                            <h5 class="mb-0">Order Items</h5>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="table-responsive">
                                                                            <table class="table align-middle text-center">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th class="product-image">
                                                                                            {{ __('string.product image') }}
                                                                                        </th>
                                                                                        <th class="product-name">
                                                                                            {{ __('string.product name') }}
                                                                                        </th>
                                                                                        <th class="product-price">
                                                                                            {{ __('string.product price') }}
                                                                                        </th>
                                                                                        <th class="product-quantity">
                                                                                            {{ __('string.product quantity') }}
                                                                                        </th>
                                                                                        <th class="product-total">
                                                                                            {{ __('string.total') }}</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($order->OrderDetails as $detail)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <img src="{{ asset($detail->product->image_path) }}"
                                                                                                    alt=""
                                                                                                    class="rounded"
                                                                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                                                                            </td>
                                                                                            <td>
                                                                                                <a href="{{ route('single_product', ['productid' => $detail->product->id]) }}"
                                                                                                    class="text-decoration-none text-dark">
                                                                                                    {{ $detail->product->name }}
                                                                                                </a>
                                                                                            </td>
                                                                                            <td>${{ number_format($detail->product->price, 2) }}
                                                                                            </td>
                                                                                            <td>{{ $detail->quantity }}
                                                                                            </td>
                                                                                            <td>${{ number_format($detail->product->price * $detail->quantity, 2) }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Order Summary -->
                                                            <div class="col-lg-4">
                                                                <div class="card border-0 shadow-sm rounded-4">
                                                                    <div class="card-body">
                                                                        <div class="d-flex align-items-center mb-3">
                                                                            <i
                                                                                class="bi bi-receipt fs-4 text-success me-2"></i>
                                                                            <h5 class="mb-0">{{__('string.order summary')}}</h5>
                                                                        </div>
                                                                        <hr>
                                                                        <ul class="list-group list-group-flush">
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between border-0">
                                                                                <span class="fw-semibold">{{__('string.total')}}:</span>
                                                                                <span class="fw-bold text-success fs-5">
                                                                                    ${{ number_format($order->OrderDetails->sum(fn($x) => $x->product->price * $x->quantity), 2) }}
                                                                                </span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
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
                            @endforeach

                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="cart-buttons">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end check out section -->
@endsection
