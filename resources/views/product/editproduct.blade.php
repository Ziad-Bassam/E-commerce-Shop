@extends('layouts.master')

@section('title')
    Edit product
@endsection
@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Edit</span> Product</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div class="form-title">
                    </div>
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="post" enctype="multipart/form-data" action="{{ route('update_product') }}"
                            id="fruitkha-contact">
                            @csrf()
                            <p>
                                <input type="hidden" required style="width: 90%" placeholder="" value="{{ $product->id }}"
                                    name="id" id="id">
                                <input type="text" required style="width: 90%" placeholder="Name"
                                    value="{{ $product->name }}" name="name" id="name">
                                <br>

                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p style="display: flex;">
                                <input type="number" required style="width: 44%" class="mr-4"
                                    value="{{ $product->price }}" placeholder="Price" name="price" id="price">
                                <br>

                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="number" required style="width: 44%" value="{{ $product->quantity }}"
                                    placeholder="Quantity" name="quantity" id="quantity">
                                <br>

                                <span class="text-danger">
                                    @error('quantity')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <textarea name="description" style="width: 90%" id="description" cols="30" rows="10"
                                    placeholder="Description">{{ $product->description }}</textarea>
                            </p>
                            <br>

                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                            <p>
                                <select class="form-control" style="width: 90%" required name="category_id"
                                    id="category_id">
                                    @foreach ($categories as $category)
                                        @if ($category->id == $product->category_id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <br>

                                <span class="text-danger">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <input type="file" style="width: 90%" class="form-control" name="photo" id="photo">
                            </p>
                            <p>
                                <img src="{{ asset($product->image_path) }}" width="300" height="300"
                                    alt="error 404 not found">
                                <br>

                                <span class="text-danger">
                                    @error('photo')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p><input type="submit" value="Submit"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
