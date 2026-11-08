<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with(['category', 'products' => function ($query) {
            $query->latest();
        }])
        ->whereHas('products')
        ->get();

        $products = Product::latest()->get();
        return view('web.home', compact('products', 'subcategories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(5)
            ->get();
        return view('web.product-details', compact('product', 'relatedProducts'));
    }
}
