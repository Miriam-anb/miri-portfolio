<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Public site
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/projets/{project:slug}', [SiteController::class, 'project'])->name('projects.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/parametres', [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('/parametres', [SettingController::class, 'update'])->name('settings.update');

        Route::resource('services', ServiceController::class)->except(['show'])->names('services');
        Route::resource('projects', ProjectController::class)->except(['show'])->names('projects');

        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    });
});
