@extends('layouts.admin')

@section('title', $product->name . ' Details')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Product Details: {{ $product->name }}
</h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-md sm:rounded-lg p-6">

        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <a href="{{ route('admin.products.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                &larr; Back to Product List
            </a>
            <a href="{{ route('admin.products.edit', $product) }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-150">
                Edit Product
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="md:col-span-1">
                <h3 class="text-lg font-semibold mb-3">Image</h3>
                <div class="w-full bg-gray-200 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-auto object-cover">
                </div>
            </div>

            <div class="md:col-span-2 space-y-6">

                <div class="space-y-4">
                    <h3 class="text-2xl font-bold text-gray-900 border-b pb-2">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-500">
                        <strong>Slug:</strong> {{ $product->slug }}
                    </p>
                </div>

                <div class="border-t pt-4">
                    <p class="text-sm text-gray-700">
                        <strong>Category:</strong>
                        @if($product->category)
                        <a href="{{ route('admin.categories.show', $product->category) }}"
                            class="font-medium text-indigo-600 hover:text-indigo-800 hover:underline">
                            {{ $product->category->name }}
                        </a>
                        @else
                        <span class="font-medium text-gray-500">N/A</span>
                        @endif
                    </p>

                    <p class="text-sm text-gray-700 mt-1">
                        <strong>Subcategory:</strong>
                        @if($product->subcategory)
                        <a href="{{ route('admin.subcategories.show', $product->subcategory) }}"
                            class="font-medium text-indigo-600 hover:text-indigo-800 hover:underline">
                            {{ $product->subcategory->name }}
                        </a>
                        @else
                        <span class="font-medium text-gray-500">N/A</span>
                        @endif
                    </p>
                </div>

                <div class="border-t pt-4">
                    <div>
                        <h4 class="text-xl font-semibold mb-2">Pricing</h4>

                        @if($product->discount_value > 0)

                        <p class="text-3xl font-bold text-green-600">
                            {{ number_format($product->new_price, 2) }} BDT
                        </p>

                        <p class="text-sm text-gray-500 line-through">
                            Regular Price: {{ number_format($product->price, 2) }} BDT
                        </p>

                        <p class="text-sm text-red-600 mt-2">
                            <strong>Discount:</strong>
                            {{ $product->discount_type == 'percentage' ? $product->discount_value . '%' :
                            number_format($product->discount_value, 2) . ' BDT Fixed' }}
                        </p>

                        @else
                        <p class="text-3xl font-bold text-gray-900">
                            {{ number_format($product->price, 2) }} BDT
                        </p>
                        <p class="text-sm text-gray-500 mt-2">
                            No discount applied.
                        </p>
                        @endif

                    </div>

                    <div class="border-t pt-4">
                        <h4 class="text-xl font-semibold mb-2">Description</h4>
                        <div class="text-gray-700 leading-relaxed">
                            {{ $product->description ?? 'No description provided.' }}
                        </div>
                    </div>
                </div>

            </div>

            <div class="border-t mt-8 pt-4 text-xs text-gray-400">
                <p>Created At: {{ $product->created_at->format('M d, Y h:i A') }}</p>
                <p>Last Updated: {{ $product->updated_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>
    </div>
    @endsection
