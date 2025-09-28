@extends('layouts.admin')

@section('title', 'Subcategory Details')

@section('header')
<div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Subcategory: {{ $subcategory->name }}
    </h2>
    <a href="{{ route('admin.subcategories.index') }}"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        Back to Subcategories
    </a>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Subcategory Details</h3>
            <p><strong>Name:</strong> {{ $subcategory->name }}</p>
            <p><strong>Slug:</strong> {{ $subcategory->slug }}</p>
            <p><strong>Parent Category:</strong>
                <a href="{{ route('admin.categories.show', $subcategory->category) }}"
                    class="text-blue-500 hover:underline">
                    {{ $subcategory->category->name }}
                </a>
            </p>
            <p><strong>Created At:</strong> {{ $subcategory->created_at->format('M d, Y') }}</p>
            <p><strong>Updated At:</strong> {{ $subcategory->updated_at->format('M d, Y') }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Products</h3>
            @if ($subcategory->products->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach ($subcategory->products as $product)
                <li class="py-3 flex items-center justify-between">
                    <span class="text-gray-700">{{ $product->name }}</span>
                    <a href="{{ route('admin.products.show', $product) }}"
                        class="text-blue-500 hover:underline">View</a>
                </li>
                @endforeach
            </ul>
            @else
            <p>No products found for this subcategory.</p>
            @endif
        </div>
    </div>
</div>
@endsection
