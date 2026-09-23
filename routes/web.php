<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/event', 'event')->name('event');
    Route::get('/activity', 'activity')->name('activity');
    Route::get('/service', 'service')->name('service');
    Route::get('/contact', 'contact')->name('contact');
    // cache clear from browser (local only)
    Route::get('/clear-cache', 'clearCache')->name('clear.cache');
});

Route::get('/clear', function () {
    \Artisan::call('optimize:clear');
    return 'Cache cleared!';
});

Route::get('/storage-link', function () {
    \Artisan::call('storage:link');
    return 'Storage linked!';
});

Route::get('/login',   [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',  [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/registrations', [RegistrationController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('registrations.store');

Route::prefix('admin')->name('admin.') ->middleware(['auth'])   ->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Events — full resource
    Route::resource('events', EventController::class);

    // Registrations — everything except store
    Route::resource('registrations', RegistrationController::class)
        ->except(['store']);

    Route::put('registrations/{registration}/status',
                [RegistrationController::class, 'updateStatus'])
        ->name('registrations.updateStatus');

    // User Management
    Route::resource('users', UserController::class);

    Route::patch('users/{user}/toggle-status',
                [UserController::class, 'toggleStatus'])
        ->name('users.toggleStatus');
});