@extends('layouts.master')

@section('title')
    Add product
@endsection
@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Add</span> Products</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div class="form-title">
                    </div>
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="post" enctype="multipart/form-data" action="{{route('store_product')}}" id="fruitkha-contact">
                            @csrf()
                            <p>
                                <input type="text" required style="width: 90%" placeholder="Name"
                                    value="{{ old('name') }}" name="name" id="name">
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p style="display: flex;">
                                <input type="number" required style="width: 44%" class="mr-4" value="{{ old('price') }}"
                                    placeholder="Price" name="price" id="price">
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="number" required style="width: 44%" value="{{ old('quantity') }}"
                                    placeholder="Quantity" name="quantity" id="quantity">
                                <span class="text-danger">
                                    @error('quantity')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <textarea name="description" style="width: 90%" id="description" cols="30" rows="10"
                                    placeholder="Description">{{ old('description') }}</textarea>
                            </p>
                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                            <p>
                                <select class="form-control" style="width: 90%" required name="category_id" id="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <input type="file" style="width: 90%" class="form-control" name="photo" id="photo">
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
