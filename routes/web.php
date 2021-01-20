<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\UserController::class, 'edit'])->name('profile');
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
Route::post('/profile/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('profile.update');
Route::view('/contact', 'contact')->name('contact');

Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('landing');

Route::group(['name' => 'shop'], function () {
    Route::get('shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
    Route::get('shop/{product:slug}', [App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');
});

Route::group(['name' => 'cart', 'middleware' => 'auth'], function () {
    Route::get('cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::delete('cart/{product}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
    Route::put('/cart/{product}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');

    Route::group(['name' => 'cart.saveForLater'], function () {
        Route::post('/cart/later/{product}', [App\Http\Controllers\SaveForLaterController::class, 'store'])->name('saveForLater.store');
        Route::put('/cart/later/{product}', [App\Http\Controllers\SaveForLaterController::class, 'update'])->name('saveForLater.update');
        Route::delete('/cart/later/{product}', [App\Http\Controllers\SaveForLaterController::class, 'destroy'])->name('saveForLater.destroy');
    });

    Route::group(['name' => 'product.comments'], function () {
        Route::post('/product/{product}/comments', [App\Http\Controllers\ProductCommentController::class, 'store'])->name('comment.store');
        Route::delete('/products/{product}/comments/{comment}', [App\Http\Controllers\ProductCommentController::class, 'destroy'])->name('comment.destroy');
    });
});

Route::group(['name' => 'checkout', 'middleware' => 'auth'], function () {
    Route::get('checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('thankyou', [App\Http\Controllers\ConfirmationController::class, 'index']);
    
    Route::post('/coupon', [App\Http\Controllers\CouponController::class, 'store'])->name('coupon.store');
    Route::delete('/coupon', [App\Http\Controllers\CouponController::class, 'destroy'])->name('coupon.destroy');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
