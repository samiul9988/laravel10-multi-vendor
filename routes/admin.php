<?php

use App\Http\Controllers\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\ProductImageGalleryController;
use App\Http\Controllers\ProductController;
use App\Models\ProductImageGallery as ProductImageGallery;
use Illuminate\Support\Facades\Route as Route;
use App\Http\Controllers\backend\AdminController;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

/** profile route */

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('update/profile', [ProfileController::class, 'updateProfile'])->name('update.profile');
Route::post('update/profile/password', [ProfileController::class, 'updatePassword'])->name('update.password');

//Route::middleware(['web'])->group(function () {
//    Route::put('admin/category/change-status', 'CategoryController@changeStatus')->name('category.change-status');
//});



/** slider route */
Route::resource('slider', SliderController::class);

/** Category route */
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

/** Sub Category route */
Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

/** Child Category route */
Route::put('Child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subCategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subCategories');
Route::resource('child-category', ChildCategoryController::class);

/** Brand route */
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

/** Admin Vendor Profile route */

Route::resource('vendor-profile', AdminVendorProfileController::class);

/** Porducts route */
Route::get('products/subcategories', [ProductController::class, 'getSubCategory'])->name('product-SubCategory');
Route::get('products/childCategories', [ProductController::class, 'getChildCategory'])->name('product-getChildCategory');
Route::resource('products', ProductController::class);
Route::resource('product-gallery', ProductImageGalleryController::class);
