<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Index::class)->name('home');
Route::get('/test', \App\Livewire\Test::class)->name('test');

Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
    Route::get('/cart', \App\Livewire\User\Order\Cart::class)->name('cart');
    Route::get('/select-seat', \App\Livewire\User\Order\Index::class)->name('select-seat');
    Route::get('/checkout', \App\Livewire\User\Order\Checkout::class)->name('checkout');

    Route::prefix('user')->group(function () {
        Route::get('/dashboard', \App\Livewire\User\Dashboard::class)->name('user.dashboard');
        Route::get('/ticket', \App\Livewire\User\Ticket::class)->name('user.ticket');
    });
});

Route::middleware('isAdmin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', \App\Livewire\Admin\Index::class)->name('admin.dashboard');
        Route::get('/users', \App\Livewire\Admin\Users::class)->name('admin.users');
        Route::get('/seats', \App\Livewire\Admin\Seats::class)->name('admin.seats');
        Route::get('/discounts', \App\Livewire\Admin\Discounts::class)->name('admin.discounts');
        Route::get('/transactions', \App\Livewire\Admin\Transactions::class)->name('admin.transactions',);
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
    Route::get('/register', \App\Livewire\Auth\Register::class)->name('register');
});
