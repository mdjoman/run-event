<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SmsBroadcastController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\GalleryController;


Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/event', 'event')->name('event');
    Route::get('/activity', 'activity')->name('activity');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/form', 'form')->name('form');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::post('/gallery/store', 'storeGallery')->name('gallery.store');
    Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.show');
    Route::get('/blog', 'blog')->name('blog');
    Route::post('/blog/store', 'storeBlog')->name('blog.store');
    Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/clear-cache', 'clearCache')->name('clear.cache');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(BlogController::class)->group(function () {
        Route::get('/blog', 'index')->name('blog.index');
        Route::get('/blog/{id}/edit', 'edit')->name('blog.edit');
        Route::patch('/blog/{id}/status', 'toggleStatus')->name('blog.status');
        Route::delete('/blog/{id}', 'destroy')->name('blog.destroy');
        Route::put('/blog/{blog}', 'update')->name('blog.update');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(GalleryController::class)->group(function () {
        Route::get('/gallery', 'index')->name('gallery.index');
        Route::get('/gallery/{id}/edit', 'edit')->name('gallery.edit');
        Route::patch('/gallery/{id}/approve', 'approve')->name('gallery.approve');
        Route::put('/gallery/{id}', 'update')->name('gallery.update');
        Route::delete('/gallery/{id}', 'destroy')->name('gallery.destroy');
        Route::get('/gallery-categories', 'categoryIndex')->name('gallery.category.index');
        Route::post('/gallery-category/store', 'storeCategory')->name('gallery.category.store');
        Route::delete('/gallery-category/{id}', 'destroyCategory')->name('gallery.category.destroy');
        Route::get('/gallery-category/{id}/edit', 'editCategory')->name('gallery.category.edit');
        Route::put('/gallery-category/{id}', 'updateCategory')->name('gallery.category.update');
        Route::post('/gallery-category/store-ajax', 'storeAjax')->name('gallery.category.storeAjax');
        Route::patch('/gallery/{id}/status', 'status')->name('gallery.status');
    });
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

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('events', EventController::class);

    Route::resource('registrations', RegistrationController::class)
        ->except(['store']);

    Route::put('registrations/{registration}/status',
                [RegistrationController::class, 'updateStatus'])
        ->name('registrations.updateStatus');

    Route::resource('users', UserController::class);

    Route::patch('users/{user}/toggle-status',
                [UserController::class, 'toggleStatus'])
        ->name('users.toggleStatus');

    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('blogs.index');
    Route::post('/blogs/approve/{id}', [AdminBlogController::class, 'approve'])->name('blogs.approve');
    Route::delete('/blogs/delete/{id}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');

    Route::get('sms-broadcast',              [SmsBroadcastController::class, 'index'])->name('sms.index');
    Route::post('sms-broadcast/send',        [SmsBroadcastController::class, 'send'])->name('sms.send');
    Route::get('sms-broadcast/logs',         [SmsBroadcastController::class, 'logs'])->name('sms.logs');
    Route::get('sms-broadcast/logs/{log}',   [SmsBroadcastController::class, 'showLog'])->name('sms.logs.show');
});

