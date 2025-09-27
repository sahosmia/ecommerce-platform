<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showProducts($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->latest()->get();
        return view('web.category-products', compact('category', 'products'));
    }
}
