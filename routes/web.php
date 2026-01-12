<?php

use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RiderController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [MenuItemController::class, 'index'])->name('dashboard');

    Route::post('/menu-items', [MenuItemController::class, 'store'])->name('menu-items.store');
    Route::put('/menu-items/{menuItem}', [MenuItemController::class, 'update'])->name('menu-items.update');
    Route::delete('/menu-items/{menuItem}', [MenuItemController::class, 'destroy'])->name('menu-items.destroy');

    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurants/trash', [RestaurantController::class, 'trash'])->name('restaurants.trash');
    Route::post('/restaurants/{restaurant}/restore', [RestaurantController::class, 'restore'])->name('restaurants.restore');
    Route::delete('/restaurants/{restaurant}/force-delete', [RestaurantController::class, 'forceDelete'])->name('restaurants.force-delete');
    Route::get('/restaurants/export/pdf', [RestaurantController::class, 'exportPdf'])->name('restaurants.export');
    Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
    Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update'])->name('restaurants.update');
    Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');

    // Orders Management (Admin)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

    // Rider Interface
    Route::prefix('rider')->name('rider.')->group(function () {
        Route::get('/dashboard', [RiderController::class, 'dashboard'])->name('dashboard');
        Route::get('/history', [RiderController::class, 'history'])->name('history');
        Route::post('/orders/{order}/accept', [RiderController::class, 'acceptOrder'])->name('orders.accept');
        Route::patch('/orders/{order}/status', [RiderController::class, 'updateStatus'])->name('orders.update-status');
    });

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
