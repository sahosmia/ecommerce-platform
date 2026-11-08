<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function index()
    // {
    //     $subcategories = Subcategory::with(['category', 'products' => function ($query) {
    //         $query->latest();
    //     }])
    //     ->whereHas('products')
    //     ->get();

    //     $products = Product::latest()->get();
    //     return view('web.home', compact('products', 'subcategories'));
    // }




    public function index()
    {
        $products = Product::with(['category', 'subcategory'])
            ->whereHas('category')
            ->whereHas('subcategory')
            ->latest()
            ->get();

        $subcategories = Subcategory::with([
            'category',
            'products' => function ($query) {
                $query->whereHas('category')
                    ->whereHas('subcategory')
                    ->latest();
            }
        ])
            ->whereHas('products', function ($query) {
                $query->whereHas('category')
                    ->whereHas('subcategory');
            })
            ->get();

        return view('web.home', compact('products', 'subcategories'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'subcategory'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->whereHas('category')
            ->whereHas('subcategory')
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('web.product-details', compact('product', 'relatedProducts'));
    }
}
