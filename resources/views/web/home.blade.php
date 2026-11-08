@extends('layouts.web')

@section('title', 'All Products Organized by Subcategory')

@section('content')
    <div class="mb-10 text-center">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">Featured Products by Subcategory</h1>
        <p class="mt-2 text-base text-gray-600 max-w-2xl mx-auto">Browse through our product catalog organized by their respective subcategories.</p>
    </div>

    @if($subcategories->isEmpty() && $products->isEmpty())
        <div class="bg-white rounded-lg shadow-sm p-8 text-center text-gray-600">
            <p>No products found at this moment.</p>
        </div>
    @else
        @foreach($subcategories as $subcategory)
            <div class="mb-12">
                <div class="flex items-center justify-between border-b pb-3 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $subcategory->name }}</h2>
                        @if($subcategory->category)
                        <span class="text-sm text-gray-500">Under <a href="{{ route('category.products', $subcategory->category->slug) }}" class="text-indigo-600 hover:underline">{{ $subcategory->category->name }}</a></span>
                        @endif
                    </div>
                    <a href="{{ route('subcategory.products', $subcategory->slug) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                        View All ({{ $subcategory->products->count() }}) &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($subcategory->products->take(4) as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        @endforeach

        @if($products->isNotEmpty())
            <div class="mt-16 pt-8 border-t border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">All Products Catalog</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endsection
