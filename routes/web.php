<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    sweetAlert2([
        'icon' => 'info',
        'text' => 'Prueba del SweetAlert2',
        'timer' => 3000,
    ]);
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('dashboard');
    })->name('home');
});
