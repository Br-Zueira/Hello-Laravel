<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GenericViewsController;

use App\Models\Excuse;

// Index Page
Route::get('/', [IndexController::class, 'index'])->name('index');

// Excuse API
Route::get('/excuse', [IndexController::class, 'getExcuse'])->name('getExcuse');

// Show the login form
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Handle the form submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Handle logging out
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'panel'])->name('admin.panel');
    Route::get('/edit/{model}/{id}', [AdminController::class, 'edit'])->name('admin.edit');
});

Route::get('/genericlist/{model}/{page}', [GenericViewsController::class, 'list'])->name('generic.list');
Route::get('/list', [GenericViewsController::class, 'viewlist'])->name('genericviews.list');

Route::get('/detail/{model}/{id}', [GenericViewsController::class, 'detail'])->name('genericviews.detail');