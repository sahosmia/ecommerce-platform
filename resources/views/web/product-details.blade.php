@extends('layouts.web')

@section('title', $product->name)

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
            <div class="md:w-1/2 p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                <div class="flex items-center mb-4">
                    <span class="text-2xl font-bold text-gray-900">${{ $product->new_price }}</span>
                    @if($product->discount_value)
                        <span class="text-sm text-gray-500 line-through ml-2">${{ $product->price }}</span>
                    @endif
                </div>
                <div class="mb-4">
                    <a href="{{ route('category.products', $product->category->slug) }}" class="text-blue-500 hover:underline">{{ $product->category->name }}</a>
                    >
                    <a href="{{ route('subcategory.products', $product->subcategory->slug) }}" class="text-blue-500 hover:underline">{{ $product->subcategory->name }}</a>
                </div>
                <button class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">Add to Cart</button>
            </div>
        </div>
    </div>

    @if($relatedProducts->isNotEmpty())
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <x-product-card :product="$relatedProduct" />
                @endforeach
            </div>
        </div>
    @endif
@endsection
