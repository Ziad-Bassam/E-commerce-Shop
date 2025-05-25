@extends('layouts.master')

@section('title')
    Edit Category
@endsection
@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Edit</span> Category </h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div class="form-title">
                    </div>
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="post" enctype="multipart/form-data" action="{{ route('update_category') }}"
                            id="fruitkha-contact">
                            @csrf()
                            <p>
                                <input type="hidden" name="id" id="id" value="{{ $category->id }}">
                                <input type="text" required style="width: 90%" placeholder="Name"
                                    value="{{ $category->name }}" name="name" id="name">
                                <br>

                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>

                            <p>
                                <textarea name="description" style="width: 90%" id="description" cols="30" rows="10"
                                    placeholder="Description">{{ $category->description }}</textarea>
                            </p>
                            <br>

                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>

                            <p>
                                <input type="file" style="width: 90%" class="form-control" name="photo" id="photo">
                            </p>
                            <p>
                                <img src="{{ asset($category->image_path) }}" width="300" height="300"
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
