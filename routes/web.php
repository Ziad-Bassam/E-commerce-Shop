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
Route::get('addproduct' , [ProductController::class , 'addproduct'])->name('add_product')->middleware('checkrole:admin,salesman');

Route::get('/categories_table' , [CategoryController::class , 'categories_table'])->name('categories_table')->middleware('checkrole:admin,salesman');

Route::get('/add_category', [CategoryController::class , 'create'])->name('add_category')->middleware('checkrole:admin,salesman');
Route::post('/storecategory' , [CategoryController::class , 'store'])->name('store_category')->middleware('checkrole:admin,salesman');

Route::get('/removecategory/{catid?}', [CategoryController::class , 'destroy'])->name('delete_category')->middleware('checkrole:admin,salesman');


Route::get('/editcategory/{catid?}', [CategoryController::class , 'edit'])->name('edit_category')->middleware('checkrole:admin,salesman');
Route::post('/updatecategory' , [CategoryController::class , 'update'])->name('update_category')->middleware('checkrole:admin,salesman');






Route::get('/removeproduct/{productid?}', [ProductController::class , 'destroy'])->name('delete_product')->middleware('checkrole:admin,salesman');
Route::get('/editproduct/{productid?}', [ProductController::class , 'edit'])->name('edit_product')->middleware('checkrole:admin,salesman');
Route::post('/storeproduct' , [ProductController::class , 'store'])->name('store_product')->middleware('checkrole:admin,salesman');
Route::post('/updateproduct' , [ProductController::class , 'update'])->name('update_product')->middleware('checkrole:admin,salesman');

Route::post('/search' , [ProductController::class , 'search'])->name('search');
Route::get('/products_table' , [ProductController::class , 'products_table'])->name('products_table')->middleware('checkrole:admin,salesman');
Route::get('/cart' , [CartController::class , 'index'])->name('cart')->middleware('auth');

Route::get('/add_product_to_cart/{productid}' , [CartController::class , 'add_product_to_cart'])->name('add_product_to_cart')->middleware('auth');
Route::get('/delete_cart_product/{cartid?}', [CartController::class , 'destroy'])->name('delete_cart_product')->middleware('auth');
Route::get('/add_product_images/{productid}' , [ProductController::class , 'add_product_images'])->name('add_product_images')->middleware('checkrole:admin,salesman');
Route::get('/delete_product_photo/{photoid?}', [ProductController::class , 'delete_product_photo'])->name('delete_product_photo')->middleware('checkrole:admin,salesman');
Route::post('/store_product_image' , [ProductController::class , 'store_product_image'])->name('store_product_image')->middleware('checkrole:admin,salesman');
Route::get('/single_product/{productid?}', [ProductController::class , 'show_single_product'])->name('single_product');

Route::get('/complete/order' , [CartController::class , 'completeorder'])->name('complete_order')->middleware('auth');
Route::post('/store/order' , [CartController::class , 'store'])->name('store_order')->middleware('auth');
Route::get('/previous/orders' , [CartController::class , 'previous_orders'])->name('previous_orders')->middleware('auth');

Route::post('lang', [Controller::class , 'change_lang'])->name('change_lang');

Route::get('/admin', function(){
    return 'admin panal';
})->middleware('checkrole:admin');

Route::get('/control_panel' , [ChartsController::class , 'index'])->name('control_panel')->middleware('checkrole:admin');




