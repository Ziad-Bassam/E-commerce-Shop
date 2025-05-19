@extends('layouts.master')
@section('title')
    Review
@endsection
@section('content')
    <!-- add-review -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Add</span> Review</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div class="form-title">
                    </div>
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="post" action="{{ route('save_review') }}" id="fruitkha-contact">
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
                            <p>
                                <input type="text" required style="width: 90%" placeholder="Subject"
                                    value="{{ old('subject') }}" name="subject" id="subject">
                                <span class="text-danger">
                                    @error('subject')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p style="display: flex;">
                                <input type="tel" required style="width: 44%" class="mr-4" value="{{ old('phone') }}"
                                    placeholder="Phone" name="phone" id="phone">
                                <span class="text-danger">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="email" required style="width: 44%" value="{{ old('email') }}"
                                    placeholder="Email" name="email" id="email">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <textarea name="message" style="width: 90%" id="message" cols="30" rows="10" placeholder="message">{{ old('message') }}</textarea>
                            </p>
                            <span class="text-danger">
                                @error('message')
                                    {{ $message }}
                                @enderror
                            </span>
                            <p><input type="submit" value="Submit"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end-add-review -->



    <!-- testimonail-section -->
    <div class="testimonail-section mt-80 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">
                    @if (count($reviews) > 1)
                        <!-- More than one opinion, we use the slider -->
                        <div class="testimonial-sliders">
                            @foreach ($reviews as $review)
                                <div class="single-testimonial-slider">
                                    <div class="client-avater">
                                        <img src="" alt="">
                                    </div>
                                    <div class="client-meta">
                                        <h3>{{ $review->name }}<span>{{ $review->subject }}</span></h3>
                                        <p class="testimonial-body">
                                            {{ $review->message }}
                                        </p>
                                        <div class="last-icon">
                                            <i class="fas fa-quote-right"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Only one opinion, we display it without a slider -->
                        @foreach ($reviews as $review)
                            <div class="single-testimonial-slider">
                                <div class="client-avater">
                                    <img src="" alt="">
                                </div>
                                <div class="client-meta">
                                    <h3>{{ $review->name }}<span>{{ $review->subject }}</span></h3>
                                    <p class="testimonial-body">
                                        {{ $review->message }}
                                    </p>
                                    <div class="last-icon">
                                        <i class="fas fa-quote-right"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end testimonail-section -->
@endsection
