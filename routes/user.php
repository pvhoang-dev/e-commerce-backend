<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductDetailController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])
    ->name("home.show");

Route::get('/detail/{id}', [ProductDetailController::class, 'index'])
    ->name("detail.show");

Route::get('/home/ajax/products', [AjaxController::class, 'getProductsHomePage'])
    ->name('ajaxGetProductHomePage');

// Cart
Route::get('/cart', [CartController::class, 'index'])
    ->name("cart.show");

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name("checkout.show");

// Order
Route::post('/order/store', [OrderController::class, 'store'])
    ->name("order.store");
