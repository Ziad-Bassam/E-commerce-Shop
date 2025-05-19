@extends('layouts.master')

@section('title')
    Product page
@endsection

@section('content')
    <!-- single product -->
    <div class="single-product mt-5 mb-5">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">
                            {{__('string.product details')}}
                        </span></h3>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="single-product-img">
                        <img src="{{ asset($product->image_path) }}" alt="product image"
                            style="max-height: 200px!important;min-height : 350px!important" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3>
                            @if (session('locale') == 'en')
                                {{ $product->name }}
                            @elseif (session('locale') == 'ar')
                                {{ $product->name_AR ? $product->name_AR : $product->name }}
                            @endif
                        </h3>
                        <p class="product-price">
                            <span>
                                {{__('string.quantity')}}:
                                {{ $product->quantity }}</span>
                                {{__('string.price')}}: $
                                {{ $product->price }}
                        </p>
                        <p class="product-price">
                            {{__('string.description')}}:
                            {{ $product->description }}</p>
                        <div class="single-product-form">
                            <a href="{{ route('add_product_to_cart', ['productid' => $product->id]) }}"
                                class="btn btn-primary mt-3">
                                <i class="fas fa-shopping-cart"></i>
                                {{__('string.add to cart')}}
                            </a>
                            <p class="mt-3"><strong>
                                    {{__('string.category')}}:
                                </strong>{{ $product->Category->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- single product photos -->

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Thumbnails -->
                <div class="row">
                    @foreach ($product->ProductPhotos as $ProductPhoto)
                        <div class="col-3 mb-2">
                            <img src="{{ asset($ProductPhoto->image_path) }}" class="img-thumbnail thumb-image"
                                style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" alt="Thumbnail"
                                onclick="showInModal(this.src)">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- end single product photos -->






    <!-- end single product -->


    <!-- more products -->
    <div class="more-products mb-150">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">
                            {{__('string.related products')}}
                        </span></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedproducts as $product)
                    <div class="col-lg-4 col-md-6 text-center">
                        <a href="{{ route('single_product' , ['productid' => $product->id]) }}">
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
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
    </div>
    <!-- end more products -->


    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md"> <!-- Leave the model medium and small -->
            <div class="modal-content bg-dark">
                <div class="modal-body p-2 text-center">
                    <img id="modalImage" src="" alt="Zoomed Image" class="img-fluid rounded"
                        style="max-height: 600px; max-width: 100%; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <!-- end Modal -->
@endsection


<script>
    function showInModal(src) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = src;
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }
</script>
