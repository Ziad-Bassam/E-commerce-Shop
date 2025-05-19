@extends('layouts.master')

@section('title')
    Add photos of the product
@endsection
@section('content')
    <div class="d-flex justify-content-center align-items-center mt-3 mb-3">
        <div class="card shadow-sm text-center" style="width: 18rem; border-radius: 15px;">
            <img src="{{ url($product->image_path) }}" class="card-img-top" style="height: 250px; object-fit: contain;" alt="Product Image">

            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p><span class="badge bg-secondary">Quantity: {{ $product->quantity }}</span></p>
                <p class="text-success fw-bold fs-5">{{ $product->price }} $</p>
            </div>
        </div>
    </div>
    <div class="container mt-3 mb-3" style="text-align:center">


        <div class="row mt-3 mb-3">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('store_product_image') }}" method="post" enctype="multipart/form-data">
                    @csrf()
                    <input type="hidden" class="form-control" name="product_id" id="product_id"
                        value="{{ $product->id }}">
                    <div class="mb-3">
                        <label for="photo" class="form-label fw-bold">Upload Photo</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                        @error('photo')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>




        <div class="row">
            @foreach ($productphotos as $productphoto)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="d-flex justify-content-center align-items-center"
                            style="height: 250px; background-color: #f8f9fa;">
                            <img src="{{ asset($productphoto->image_path) }}" alt="Product Photo"
                                style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                        <div class="card-body text-center">
                            <a href="{{ route('delete_product_photo', ['photoid' => $productphoto->id]) }}"
                                class="btn btn-danger">
                                <i class="fa fa-trash"></i>&nbsp;Delete Photo
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
