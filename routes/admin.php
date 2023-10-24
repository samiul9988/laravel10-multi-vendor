<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\backend\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AdminController;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

/** profile route */

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('update/profile', [ProfileController::class, 'updateProfile'])->name('update.profile');
Route::post('update/profile/password', [ProfileController::class, 'updatePassword'])->name('update.password');


/** slider route */
Route::resource('category', CategoryController::class);

/** slider route */
Route::resource('slider', SliderController::class);
