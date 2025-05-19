@extends('layouts.master')

@section('title')
    Products
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{__('string.products')}}</span></h3>
                        <p>{{__('string.enjoy shopping through our branches')}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 text-center">
                        <a href="{{ route('single_product', ['productid' => $product->id]) }}">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <img src="{{ url($product->image_path) }}"
                                        style="max-height: 200px!important;min-height : 350px!important" alt="">
                                </div>
                                <h3>
                                    @if (session('locale') == 'en')
                                        {{ $product->name }}
                                    @elseif (session('locale') == 'ar')
                                        {{ $product->name_AR ? $product->name_AR : $product->name }}
                                    @endif
                                </h3>
                                <p class="product-price"><span>{{ $product->quantity }}</span> {{ $product->price }} $ </p>


                                <a href="{{ route('add_product_to_cart', ['productid' => $product->id]) }}"
                                    class="cart-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                    {{__('string.add to cart')}}
                                </a>



                                @if (Auth::user() && (Auth::user()->role == 'admin' || Auth::user()->role == 'salesman'))
                                    <p class="mt-3">
                                        <a href="{{ route('edit_product', ['productid' => $product->id]) }}"
                                            class="btn btn-success d-block mt-2 mb-2"><i class="fa fa-pen"></i>&nbsp;Edit
                                            product</a>
                                        <a href="{{ route('add_product_images', ['productid' => $product->id]) }}"
                                            class="btn btn-dark d-block mt-2 mb-2"><i class="fa fa-image"></i>&nbsp;Add
                                            photos
                                            of
                                            product</a>
                                        <a href="{{ route('delete_product', ['productid' => $product->id]) }}"
                                            class="btn btn-danger d-block mt-2 mb-2"><i class="fa fa-trash"></i>&nbsp;Delete
                                            product</a>
                                    </p>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>


            <div class="row">
                <div class="col-lg-12 text-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- end product section -->
@endsection


<style>
    svg {
        height: 10px !important;
    }
</style>
