<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Subcategory;

class CategoryController extends Controller
{
    /**
     * Show products by category and optionally by subcategory via clean unified route.
     */
    public function showCategoryOrSubcategory($categorySlug, $subcategorySlug = null)
    {
        $category = Category::with('subcategories')->where('slug', $categorySlug)->firstOrFail();

        if ($subcategorySlug) {
            $subcategory = Subcategory::where('category_id', $category->id)
                ->where('slug', $subcategorySlug)
                ->firstOrFail();

            $products = Product::where('subcategory_id', $subcategory->id)->latest()->get();
            return view('web.subcategory-products', compact('subcategory', 'products'));
        }

        $products = Product::where('category_id', $category->id)->latest()->get();
        return view('web.category-products', compact('category', 'products'));
    }

    /**
     * Legacy route handler for /category/{slug}
     */
    public function showProducts($slug)
    {
        return $this->showCategoryOrSubcategory($slug);
    }
}
