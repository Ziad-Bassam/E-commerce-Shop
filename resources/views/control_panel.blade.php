<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce control panel</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
            --dark-color: #5a5c69;
            --light-color: #f8f9fc;
            --sidebar-width: 250px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fc;
            color: #333;
            direction: rtl;
        }

        /* Layout */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .app-sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            position: fixed;
            height: 100vh;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .user-info {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-info h4 {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .user-info span {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .side-menu {
            list-style: none;
            padding: 0;
        }

        .side-item-category {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 800;
            padding: 1.5rem 1rem 0.5rem;
            letter-spacing: 0.05rem;
        }

        .side-menu__item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
        }

        .side-menu__item:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .side-menu__icon {
            width: 1.2rem;
            height: 1.2rem;
            margin-left: 0.5rem;
            fill: currentColor;
        }

        .side-menu__label {
            font-size: 0.85rem;
        }

        .slide-menu {
            list-style: none;
            padding-right: 2rem;
            background-color: rgba(0, 0, 0, 0.1);
            display: none;
        }

        .slide-item {
            display: block;
            padding: 0.5rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.3s;
        }

        .slide-item:hover {
            color: white;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-right: var(--sidebar-width);
            padding: 1.5rem;
            transition: all 0.3s;
        }

        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .page-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            display: flex;
            list-style: none;
            padding: 0;
            font-size: 0.85rem;
            color: var(--dark-color);
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "/";
            padding: 0 0.5rem;
        }

        /* Summary Cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .summary-card {
            background-color: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .summary-card:hover {
            transform: translateY(-5px);
        }

        .card-primary {
            border-left: 0.25rem solid var(--primary-color);
        }

        .card-success {
            border-left: 0.25rem solid var(--secondary-color);
        }

        .card-warning {
            border-left: 0.25rem solid var(--warning-color);
        }

        .card-danger {
            border-left: 0.25rem solid var(--danger-color);
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            color: var(--dark-color);
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .card-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-icon {
            font-size: 2rem;
            opacity: 0.3;
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Charts */
        .charts-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .chart-container {
            background-color: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 1.25rem;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .chart-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        canvas {
            width: 100% !important;
            height: 100% !important;
            min-height: 250px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .charts-row {
                grid-template-columns: 1fr;
            }

            .app-sidebar {
                transform: translateX(var(--sidebar-width));
            }

            .main-content {
                margin-right: 0;
            }

            .sidebar-toggle {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .summary-cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 576px) {
            .summary-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="app-container">
        <!-- Sidebar -->
        <aside class="app-sidebar">
            <div class="sidebar-header">
                <h3>Control panel</h3>
            </div>

            <div class="user-info">
                <h2>
                <span>Admin</span></h2>
                <!-- Auth links -->
                @guest
                    @if (Route::has('login'))
                        <li><a style="color: rgb(204, 250, 228)" href="{{ route('login') }}">{{ __('string.login') }}</a></li>
                    @endif
                    @if (Route::has('register'))
                        <li><a style="color:rgb(204, 250, 228)" href="{{ route('register') }}">{{ __('string.register') }}</a></li>
                    @endif
                @else
                    <h3><span style="color: rgb(204, 250, 228)" href="#">{{ Auth::user()->name }}</span></h3>


                        <h3><a style="color: rgb(204, 250, 228)" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a></h3>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                @endguest

            </div>

            <ul class="side-menu">
                <li class="side-item side-item-category">Home</li>
                <li>
                    <a class="side-menu__item" href="/charts">
                        <svg class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                        </svg>
                        <span class="side-menu__label">Home</span>
                    </a>
                </li>

                <li class="side-item side-item-category">categories</li>
                <li>
                    <a class="side-menu__item" href="#">
                        <svg class="side-menu__icon" viewBox="0 0 24 24">
                            <path
                                d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z" />
                            <path d="M7 12h2v5H7zm4-7h2v12h-2zm4 5h2v7h-2z" />
                        </svg>
                        <span class="side-menu__label">categories</span>
                        <i class="fas fa-chevron-down angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ route('category') }}">List of categories</a></li>
                        <li><a class="slide-item" href="#">Add categories</a></li>
                        <li><a class="slide-item" href="#">Edit categories</a></li>
                        <li><a class="slide-item" href="#">Delete categories</a></li>
                    </ul>
                </li>

                {{-- <li class="side-item side-item-category">التقارير</li>
      <li>
        <a class="side-menu__item" href="#">
          <svg class="side-menu__icon" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
            <path d="M12.34 7.45c-.2-.2-.51-.2-.71 0L7.45 11.5c-.32.31-.1.85.35.85H11v4.29c0 .45.54.67.85.35l4.09-4.09c.2-.2.2-.51 0-.71l-3.6-3.6z"/>
          </svg>
          <span class="side-menu__label">التقارير</span>
          <i class="fas fa-chevron-down angle"></i>
        </a>
        <ul class="slide-menu">
          <li><a class="slide-item" href="#">تقارير الفواتير</a></li>
          <li><a class="slide-item" href="#">تقارير العملاء</a></li>
        </ul>
      </li> --}}

                <li class="side-item side-item-category">Users</li>
                <li>
                    <a class="side-menu__item" href="#">
                        <svg class="side-menu__icon" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                        </svg>
                        <span class="side-menu__label">Users</span>
                        <i class="fas fa-chevron-down angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="#">List of Users</a></li>
                    </ul>
                </li>

                <li class="side-item side-item-category">Settings</li>
                <li>
                    <a class="side-menu__item" href="#">
                        <svg class="side-menu__icon" viewBox="0 0 24 24">
                            <path
                                d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z" />
                        </svg>
                        <span class="side-menu__label">Settings</span>
                        <i class="fas fa-chevron-down angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ route('category') }}">categories</a></li>
                        <li><a class="slide-item" href="{{ route('product') }}">Products</a></li>
                        <li><a class="slide-item" href="{{ route('add_product') }}">Add Product</a></li>
                        <li><a class="slide-item" href="{{ route('products_table') }}">Products table</a></li>
                    </ul>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-title">
                    <h1>E-commerce control panel</h1>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Control panel</li>
                    </ul>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="summary-card card-primary">
                    <div class="card-body">
                        <div class="card-title">Total sales</div>
                        <div class="card-value">{{ $totalPrice }} $</div>
                        {{-- <i class="fas fa-dollar-sign card-icon"></i> --}}
                    </div>
                </div>

                <div class="summary-card card-success">
                    <div class="card-body">
                        <div class="card-title">Number of requests</div>
                        <div class="card-value">{{ $orderCount }}</div>
                        {{-- <i class="fas fa-shopping-cart card-icon"></i> --}}
                    </div>
                </div>

                <div class="summary-card card-warning">
                    <div class="card-body">
                        <div class="card-title">Number of clients</div>
                        <div class="card-value">{{ $customerCount }}</div>
                        {{-- <i class="fas fa-users card-icon"></i> --}}
                    </div>
                </div>

                <div class="summary-card card-danger">
                    <div class="card-body">
                        <div class="card-title">Available products</div>
                        <div class="card-value">{{ $productCount }}</div>
                        {{-- <i class="fas fa-boxes card-icon"></i> --}}
                    </div>
                </div>

                <div class="summary-card card-danger">
                    <div class="card-body">
                        <div class="card-title">Number of orders per month</div>
                        <div class="card-value">{{ $ordersmonth }}</div>
                        {{-- <i class="fas fa-boxes card-icon"></i> --}}
                    </div>
                </div>
                <div class="summary-card card-danger">
                    <div class="card-body">
                        <div class="card-title">Daily Sales (last 7 days)</div>
                        <div class="card-value">{{ $ordersweek }}</div>
                        {{-- <i class="fas fa-boxes card-icon"></i> --}}
                    </div>
                </div>
        </main>
    </div>

    <script>
        // Toggle submenus
        document.querySelectorAll('.side-menu__item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (this.nextElementSibling && this.nextElementSibling.classList.contains('slide-menu')) {
                    e.preventDefault();
                    this.nextElementSibling.style.display = this.nextElementSibling.style.display ===
                        'block' ? 'none' : 'block';
                    this.querySelector('.angle').classList.toggle('fa-chevron-up');
                }
            });
        });
    </script>

</body>

</html>
