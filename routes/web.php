<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [ProductController::class, 'view'])->name('product.view');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product:slug}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/get-total-count', [CartController::class, 'getTotalCount'])->name('cart.total-count');
Route::post('/cart/remove/{product:slug}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update-quantity/{product:slug}', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
