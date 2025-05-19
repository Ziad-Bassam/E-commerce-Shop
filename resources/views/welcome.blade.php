@extends('layouts.master')

@section('title')
    Home
@endsection
@section('content')
    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('string.categories') }}</span></h3>
                        <p>{{ __('string.enjoy shopping through our branches') }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 text-center">
                        <a href="{{ route('product', ['catid' => $category->id]) }}">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <img src="{{ url($category->image_path) }}"
                                        style="max-height: 250px!important;min-height : 250px!important" alt="">
                                </div>
                                <h3>
                                    @if (session('locale') == 'en')
                                        {{ $category->name }}
                                    @elseif (session('locale') == 'ar')
                                        {{ $category->name_AR ? $category->name_AR : $category->name }}
                                    @endif
                                </h3>

                                <h6>{{ $category->description }}</h6>

                                @if (Auth::user() && (Auth::user()->role == 'admin' || Auth::user()->role == 'salesman'))
                                    <p>
                                        <a href="{{ route('edit_category', ['catid' => $category->id]) }}"
                                            class="btn btn-success d-block mt-2 mb-2"><i class="fa fa-pen"></i>&nbsp;Edit
                                            category</a>

                                        <a href="{{ route('delete_category', ['catid' => $category->id]) }}"
                                            class="btn btn-danger d-block mt-2 mb-2"><i class="fa fa-trash"></i>&nbsp;Delete
                                            category</a>
                                    </p>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>


            <div class="row">
                <div class="col-lg-12 text-center">
                    {{ $categories->links() }}
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
