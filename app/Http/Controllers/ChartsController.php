<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ChartsController extends Controller
{
    public function index()
    {
        $adminCount = User::where('role', 'admin')->count();
        $salesmanCount = User::where('role', 'salesman')->count();
        $customerCount = User::where('role', '')->count();
        $productCount = Product::count();
        $categoryCount = Category::count();
        $orderCount = Order::count();
        $totalPrice = OrderDetails::sum('price');
        $totalQuantity = Product::sum('quantity');

        $ordersmonth = OrderDetails::where('created_at', '>=', Carbon::now()->subDays(30))
                ->orderBy('created_at', 'desc')
                ->get()
                ->count();

        $ordersweek = OrderDetails::where('created_at', '>=', Carbon::now()->subDays(7))
                ->orderBy('created_at', 'desc')
                ->get()
                ->count();



        return view('control_panel' , ['customerCount' => $customerCount ,
            'orderCount' => $orderCount ,
            'productCount' => $productCount ,
            'categoryCount' => $categoryCount ,
            'adminCount' => $adminCount ,
            'salesmanCount' => $salesmanCount ,
            'totalPrice' => $totalPrice,
            'ordersmonth' => $ordersmonth,
            'ordersweek' => $ordersweek,
        ]);

    }
}
