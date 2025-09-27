<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;


Route::get('subcategories/{category_id}', [CategoryController::class, 'getSubcategories'])->name('api.subcategories');
