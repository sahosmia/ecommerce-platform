@extends('layouts.admin')

@section('title', 'Category Details')

@section('header')
<div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Category: {{ $category->name }}
    </h2>
    <a href="{{ route('admin.categories.index') }}"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        Back to Categories
    </a>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Category Details</h3>
            <p><strong>Name:</strong> {{ $category->name }}</p>
            <p><strong>Slug:</strong> {{ $category->slug }}</p>
            <p><strong>Created At:</strong> {{ $category->created_at->format('M d, Y') }}</p>
            <p><strong>Updated At:</strong> {{ $category->updated_at->format('M d, Y') }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Subcategories</h3>
            @if ($category->subcategories->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach ($category->subcategories as $subcategory)
                <li class="py-3 flex items-center justify-between">
                    <span class="text-gray-700">{{ $subcategory->name }}</span>
                    <a href="{{ route('admin.subcategories.show', $subcategory) }}"
                        class="text-blue-500 hover:underline">View</a>
                </li>
                @endforeach
            </ul>
            @else
            <p>No subcategories found for this category.</p>
            @endif
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Products</h3>
            @if ($category->products->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach ($category->products as $product)
                <li class="py-3 flex items-center justify-between">
                    <span class="text-gray-700">{{ $product->name }}</span>
                    <a href="{{ route('admin.products.show', $product) }}"
                        class="text-blue-500 hover:underline">View</a>
                </li>
                @endforeach
            </ul>
            @else
            <p>No products found for this category.</p>
            @endif
        </div>
    </div>
</div>
@endsection
