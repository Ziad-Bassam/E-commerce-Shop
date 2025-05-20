<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>@yield('title')</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- mean menu css -->
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <style>
        .subtitle {
            letter-spacing: 0px !important
        }
    </style>
    @stack('styles')
</head>

<body>

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

    <!-- header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="main-menu-wrap d-flex justify-content-between align-items-center">

                        <!-- logo -->
                        <div class="site-logo">
                            <a href="/" style="font-size: 14px; font-weight: bold; color: #ff9634;">
                                E-commerce Store
                            </a>
                        </div>
                        <!-- menu -->
                        <nav class="main-menu">
                            <ul class="d-flex gap-3 align-items-center mb-0" style="list-style: none;">
                                @if (Auth::user() && Auth::user()->role == 'admin')
                                    <li><a href="{{ route('control_panel') }}">{{ __('string.control panel') }}</a>
                                    </li>
                                @endif

                                <li><a href="{{ route('category') }}">{{ __('string.categories') }}</a>
                                    @if (Auth::user() && (Auth::user()->role == 'admin' || Auth::user()->role == 'salesman'))
                                        <ul class="sub-menu">
                                            <li><a
                                                    href="{{ route('add_category') }}">{{ __('string.add category') }}</a>
                                            </li>
                                            <li><a
                                                    href="{{ route('categories_table') }}">{{ __('string.categories table') }}</a>
                                            </li>
                                        </ul>
                                    @endif
                                </li>


                                <li><a href="{{ route('product') }}">{{ __('string.products') }}</a>
                                    @if (Auth::user() && (Auth::user()->role == 'admin' || Auth::user()->role == 'salesman'))
                                        <ul class="sub-menu">
                                            <li><a
                                                    href="{{ route('add_product') }}">{{ __('string.add_product') }}</a>
                                            </li>
                                            <li><a
                                                    href="{{ route('products_table') }}">{{ __('string.products_table') }}</a>
                                            </li>
                                        </ul>
                                    @endif
                                </li>

                                <li><a href="{{ route('reviews') }}">{{ __('string.reviews') }}</a></li>

                                <!-- Auth links -->
                                @guest
                                    @if (Route::has('login'))
                                        <li><a href="{{ route('login') }}">{{ __('string.login') }}</a></li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">{{ __('string.register') }}</a></li>
                                    @endif
                                @else
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('string.logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                    <li><a href="#">{{ Auth::user()->name }}</a></li>
                                @endguest

                                <li>
                                    <a class="shopping-cart" href="{{ route('cart') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                                </li>

                                <!-- language switch -->
                                <li>
                                    <form action="{{ route('change_lang') }}" method="post">
                                        @csrf
                                        <select name="locale" id="locale" onchange="this.form.submit()"
                                            class="form-select form-select-sm">
                                            <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}>
                                                English</option>
                                            <option value="ar" {{ session('locale') == 'ar' ? 'selected' : '' }}>
                                                عربي</option>
                                        </select>
                                    </form>
                                </li>
                            </ul>
                        </nav>

                        <!-- Mobile menu -->
                        <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn"><i class="fas fa-window-close"></i></span>
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <h3>Search For:</h3>
                            <form action="/search" method="post">
                                @csrf()
                                <input type="text" name="searchkey" placeholder="Search for the product">
                                <button type="submit">Search <i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search area -->

    <!-- home page slider -->
    <div class="homepage-slider">
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{ __('string.enjoy shopping') }}</p>
                                <h2 style="color: white">{{ __('string.the latest fashion') }}</h2>
                                <div class="hero-btns">
                                    <a href="/register" class="boxed-btn">{{ __('string.register') }}</a>
                                    {{-- <a href="contact.html" class="bordered-btn">Contact Us</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{ __('string.delivery') }}</p>
                                <h2 style="color: white">{{ __('string.fresh food') }}</h2>
                                <div class="hero-btns">
                                    <a href="/register" class="boxed-btn">{{ __('string.register') }}</a>
                                    {{-- <a href="contact.html" class="bordered-btn">Contact Us</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-right">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{ __('string.daily offers') }}</p>
                                <h2 style="color: white">{{ __('string.discounts products') }}</h2>
                                <div class="hero-btns">
                                    <a href="/register" class="boxed-btn">{{ __('string.register') }}</a>
                                    {{-- <a href="contact.html" class="bordered-btn">Contact Us</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end home page slider -->



    {{ trans('string.welcome') }}


    @yield('content')







    <!-- footer -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box about-widget">
                        <h2 class="widget-title">{{ __('string.about us') }}</h2>
                        <p>{{ __('string.about us text') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box get-in-touch">
                        <h2 class="widget-title">{{ __('string.get in touch') }}</h2>
                        <ul>
                            <li>Ziad Bassam</li>
                            <li><a href="https://github.com/Ziad-Bassam" style="color:orange">Github:
                                    github.com/Ziad-Bassam</a></li>
                            <li>Gmail: ziad.aliwa21@gmail.com</li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box pages">
                        <h2 class="widget-title">{{ __('string.pages') }}</h2>
                        <ul>
                            <li><a href="{{ route('category') }}">{{ __('string.categories') }}</a></li>
                            <li><a href="{{ route('product') }}">{{ __('string.products') }}</a></li>
                            <li><a href="{{ route('reviews') }}">{{ __('string.reviews') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end footer -->

    <!-- copyright -->
    <div class="copyright text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Copyrights &copy; 2024 - <a href="https://github.com/Ziad-Bassam">Ziad Mohamed</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- end copyright -->

    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- count down -->
    <script src="{{ asset('assets/js/jquery.countdown.js') }}"></script>
    <!-- isotope -->
    <script src="{{ asset('assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
    <!-- waypoints -->
    <script src="{{ asset('assets/js/waypoints.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- magnific popup -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- mean menu -->
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
    <!-- sticker js -->
    <script src="{{ asset('assets/js/sticker.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')

</body>

</html>
