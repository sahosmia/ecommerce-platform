<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function showProducts($slug)
    {
        $subcategory = Subcategory::where('slug', $slug)->firstOrFail();
        $products = Product::where('subcategory_id', $subcategory->id)->latest()->get();
        return view('web.subcategory-products', compact('subcategory', 'products'));
    }
}
