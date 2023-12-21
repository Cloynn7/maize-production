<?php

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

Route::get('/', \App\Livewire\Index::class)->name('home');
Route::get('/test', \App\Livewire\Test::class)->name('test');

Route::middleware('auth')->group(function () {
    Route::get('/logout', function() {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
    Route::get('/cart', \App\Livewire\User\Order\Cart::class)->name('cart');
    Route::get('/select-seat', \App\Livewire\User\Order\Index::class)->name('select-seat');
    Route::get('/checkout', \App\Livewire\User\Order\Checkout::class)->name('checkout');

    Route::prefix('user')->group(function () {
        Route::get('/dashboard', \App\Livewire\User\Dashboard::class)->name('user.dashboard');
    });
});

Route::middleware('isAdmin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', \App\Livewire\Admin\Index::class)->name('admin.dashboard');
        Route::get('/users', \App\Livewire\Admin\Users::class)->name('admin.users');
        Route::get('/seats', \App\Livewire\Admin\Seats::class)->name('admin.seats');
        Route::get('/discounts', \App\Livewire\Admin\Discounts::class)->name('admin.discounts');
        // Route::get('/bookings', \App\Livewire\Admin\Bookings::class)->name('admin.bookings');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
    Route::get('/register', \App\Livewire\Auth\Register::class)->name('register');
});