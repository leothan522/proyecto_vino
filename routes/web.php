<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;

Route::get('/', [WebController::class, 'index'])->name('web.index');
Route::get('/about', [WebController::class, 'about'])->name('web.about');
Route::get('/gallery', [WebController::class, 'blog'])->name('web.blog');
Route::get('/contact', [WebController::class, 'contact'])->name('web.contact');
Route::get('/products', [WebController::class, 'products'])->name('web.products');
Route::get('/products/{id}/single', [WebController::class, 'single'])->name('web.single');
Route::get('/cart', [WebController::class, 'cart'])->name('web.cart');
Route::get('/profile', [WebController::class, 'profile'])->name('web.profile');
Route::get('/contact/download', [WebController::class, 'descargar'])->name('web.descargar');
Route::get('/compartir/app', [WebController::class, 'compartir'])->name('web.compartir');
Route::get('/delivery/{rowquid}', [WebController::class, 'entrega'])->name('web.entrega');

Route::get('/pedido/{pedido}/imprimir', [WebController::class, 'vistaTickera'])->name('pedido.imprimir');
Route::get('/pedido/{pedido}/pdf', [WebController::class, 'verPDFTickera'])->name('pedido.pdf');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', [WebController::class, 'home'])->name('web.home');
    Route::get('/checkout/{rowquid}', [WebController::class, 'checkout'])->name('web.checkout');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    \App\Http\Middleware\UserProfile::class,
])->get('user/profile', [UserProfileController::class, 'show'])->name('profile.show');

Route::get('/api/auth-check', function (Request $request) {
    return response()->json([
        'authenticated' => auth()->check(),
    ]);
})->name('auth-check');

Route::get('/{codigo?}', [WebController::class, 'index'])/*->where('codigo', '[A-Za-z0-9]{6}')*/->name('web.codigo');
