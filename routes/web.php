<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Models\Wishlist;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products', [ProductController::class, 'index'])
->middleware(['auth', 'verified'])->name('product.index');

Route::get('/product/buy/{product_id}/{quantity}', [ProductController::class, 'buy'])
->middleware(['auth', 'verified'])->name('product.buy');

Route::get('/product/addtocart/{product_id}/{quantity}', [ProductController::class, 'addtocart'])
->middleware(['auth', 'verified'])->name('product.add');
//cart
Route::get('/cart/view', [CartController::class, 'index'])
->middleware(['auth', 'verified'])->name('cart.index');
Route::get('/wishlist/view', [WishlistController::class, 'index'])
->middleware(['auth', 'verified'])->name('wishlist.index');
Route::get('/wishlist/add/{product_id}', [WishlistController::class, 'add'])
->middleware(['auth', 'verified'])->name('wishlist.add');
Route::post('/wishlist/add-to-cart', [WishlistController::class, 'addToCart'])
->middleware(['auth', 'verified'])->name('wishlist.addToCart');
Route::post('/wishlist/delete', [WishlistController::class, 'delete'])
->middleware(['auth', 'verified'])->name('wishlist.delete');

//checkout
Route::post('/checkout/payment', [OrderController::class, 'checkout'])
->middleware(['auth', 'verified'])->name('checkout.payment');

//orders
Route::get('/orders/view', [OrderController::class, 'index'])->name('order.index');

Route::post('/api/cart/increase', [CartController::class, 'increaseQuantity']);
Route::post('/api/cart/decrease', [CartController::class, 'decreaseQuantity']);
Route::post('/api/cart/remove', [CartController::class, 'removeItem']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
