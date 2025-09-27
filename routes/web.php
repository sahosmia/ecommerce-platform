<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Web\CategoryController as WebCategoryController;
use App\Http\Controllers\Web\ProductController as WebProductController;
use App\Http\Controllers\Web\SubcategoryController as WebSubcategoryController;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/', [WebProductController::class, 'index'])->name('home');

Route::get('/product/{slug}', [WebProductController::class, 'show'])->name('product.details');

Route::get('/category/{slug}', [WebCategoryController::class, 'showProducts'])->name('category.products');

Route::get('/subcategory/{slug}', [WebSubcategoryController::class, 'showProducts'])->name('subcategory.products');


/*
|--------------------------------------------------------------------------
| Admin Routes (CRUD Operations)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');
    Route::resource('categories', CategoryController::class);


    Route::get('subcategories/trash', [SubcategoryController::class, 'trash'])->name('subcategories.trash');
    Route::post('subcategories/{id}/restore', [SubcategoryController::class, 'restore'])->name('subcategories.restore');
    Route::delete('subcategories/{id}/force-delete', [SubcategoryController::class, 'forceDelete'])->name('subcategories.force-delete');
    Route::resource('subcategories', SubcategoryController::class);

    Route::get('products/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::post('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete');
    Route::resource('products', ProductController::class);
});



require __DIR__ . '/auth.php';
