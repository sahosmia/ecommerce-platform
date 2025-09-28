<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'trashed_products' => Product::onlyTrashed()->count(),
            'categories' => Category::count(),
            'trashed_categories' => Category::onlyTrashed()->count(),
            'subcategories' => Subcategory::count(),
            'trashed_subcategories' => Subcategory::onlyTrashed()->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
