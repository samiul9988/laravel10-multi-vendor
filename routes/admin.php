<?php

use App\Http\Controllers\Backend\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AdminController;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

/** profile route */

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('update/profile', [ProfileController::class, 'updateProfile'])->name('update.profile');
