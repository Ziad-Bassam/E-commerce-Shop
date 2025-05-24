<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/', [CategoryController::class , 'index'])->name('category');
Route::get('/home', [CategoryController::class , 'index'])->name('category');
Route::get('/review', [ReviewController::class , 'index'])->name('reviews');
Route::post('/storereview', [ReviewController::class , 'store'])->name('save_review')->middleware('auth');
Route::get('/products/{catid?}', [ProductController::class , 'index'])->name('product');
Route::post('/search' , [ProductController::class , 'search'])->name('search');
Route::get('/cart' , [CartController::class , 'index'])->name('cart')->middleware('auth');
Route::get('/add_product_to_cart/{productid}' , [CartController::class , 'add_product_to_cart'])->name('add_product_to_cart')->middleware('auth');
Route::get('/delete_cart_product/{cartid?}', [CartController::class , 'destroy'])->name('delete_cart_product')->middleware('auth');
Route::get('/single_product/{productid?}', [ProductController::class , 'show_single_product'])->name('single_product');
Route::get('/complete/order' , [CartController::class , 'completeorder'])->name('complete_order')->middleware('auth');
Route::post('/store/order' , [CartController::class , 'store'])->name('store_order')->middleware('auth');
Route::get('/previous/orders' , [CartController::class , 'previous_orders'])->name('previous_orders')->middleware('auth');
Route::post('lang', [Controller::class , 'change_lang'])->name('change_lang');





