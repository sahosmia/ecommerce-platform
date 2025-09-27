@extends('layouts.web')

@section('title')
{{ $category->name }} - Products
@endsection

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $category->name }}</h1>

    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Subcategories</h2>
        @if($category->subcategories->isEmpty())
            <p class="text-gray-600">No subcategories found in this category.</p>
        @else
            <div class="flex flex-wrap gap-4">
                @foreach($category->subcategories as $subcategory)
                    <a href="{{ route('subcategory.products', $subcategory->slug) }}" class="bg-white rounded-lg shadow-md p-4 hover:bg-gray-200">
                        <span class="text-lg font-semibold text-gray-800">{{ $subcategory->name }}</span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Products</h2>
    @if($products->isEmpty())
        <p class="text-gray-600">No products found in this category.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    @endif
@endsection
