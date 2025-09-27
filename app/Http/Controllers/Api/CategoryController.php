<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;

class CategoryController extends Controller
{
    /**
     * Get subcategories based on the provided category ID.
     */
    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)
                                    ->get(['id', 'name']);

        return response()->json($subcategories);
    }
}
