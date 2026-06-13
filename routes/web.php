<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GenericViewsController;
use App\Http\Controllers\EditingController;

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

// Handle routs that require to be logged to access
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'panel'])->name('admin.panel');
    
    Route::get('/edit/{model}/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::get('/create/{model}', [AdminController::class, 'create'])->name('admin.create');

    Route::post('/save', [EditingController::class, 'save'])->name('editing.save');
    Route::post('/add', [EditingController::class, 'add'])->name('editing.add');
    Route::post('/delete', [EditingController::class, 'delete'])->name('editing.delete');
});

// List view routes
Route::get('/genericlist/{model}/{page}', [GenericViewsController::class, 'list'])->name('generic.list'); // API
Route::get('/list', [GenericViewsController::class, 'viewlist'])->name('genericviews.list'); // Page

// Handle detail view
Route::get('/detail/{model}/{id}', [GenericViewsController::class, 'detail'])->name('genericviews.detail')
    ->whereNumber('id');