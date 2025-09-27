@extends('layouts.web')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $subcategory->name }}</h1>

    @if($products->isEmpty())
        <p class="text-gray-600">No products found in this subcategory.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <a href="{{ route('product.details', $product->slug) }}">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h2>
                        <p class="text-gray-600 mb-2">{{ Str::limit($product->description, 50) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-gray-900">${{ $product->new_price }}</span>
                            <a href="{{ route('product.details', $product->slug) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
