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



Route::get('addproduct' , [ProductController::class , 'create'])->name('add_product')->middleware('checkrole:admin,salesman');
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
Route::get('/products_table' , [ProductController::class , 'products_table'])->name('products_table')->middleware('checkrole:admin,salesman');
Route::get('/add_product_images/{productid}' , [ProductController::class , 'add_product_images'])->name('add_product_images')->middleware('checkrole:admin,salesman');
Route::get('/delete_product_photo/{photoid?}', [ProductController::class , 'delete_product_photo'])->name('delete_product_photo')->middleware('checkrole:admin,salesman');
Route::post('/store_product_image' , [ProductController::class , 'store_product_image'])->name('store_product_image')->middleware('checkrole:admin,salesman');
Route::get('/control_panel' , [ChartsController::class , 'index'])->name('control_panel')->middleware('checkrole:admin');
