<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->name('web.index');
Route::get('/about', [WebController::class, 'about'])->name('web.about');
Route::get('/blog', [WebController::class, 'blog'])->name('web.blog');
Route::get('/contact', [WebController::class, 'contact'])->name('web.contact');
Route::get('/products', [WebController::class, 'products'])->name('web.products');
Route::get('/products/{id}/single', [WebController::class, 'single'])->name('web.single');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', [WebController::class, 'home'])->name('web.home');
    Route::get('/cart', [WebController::class, 'cart'])->name('web.cart');
    Route::get('/checkout', [WebController::class, 'checkout'])->name('web.checkout');
});

