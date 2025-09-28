@extends('layouts.web')

@section('title')
{{ $subcategory->name }} - {{ $subcategory->category->name }}
@endsection

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $subcategory->name }}</h1>

    @if($products->isEmpty())
        <p class="text-gray-600">No products found in this subcategory.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    @endif
@endsection
