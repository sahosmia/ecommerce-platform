@extends('layouts.admin')

@section('title', $product->name . ' Details')

@section('header')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-200">
            <i class="fa-solid fa-box-open text-white text-lg"></i>
        </div>
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">{{ $product->name }}</h2>
            <p class="text-sm text-gray-500">Product details, pricing, and category information</p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.products.edit', $product) }}"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium py-2.5 px-4 rounded-xl shadow-sm transition">
            <i class="fa-solid fa-pen-to-square text-sm"></i>
            Edit Product
        </a>
        <a href="{{ route('admin.products.index') }}"
            class="inline-flex items-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2.5 px-4 rounded-xl shadow-sm transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
            Back to Products
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Product Image & Quick Info --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden p-6 text-center">
                <div class="w-full aspect-square rounded-xl bg-gray-50 overflow-hidden border border-gray-200 mb-4 flex items-center justify-center">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-bold text-gray-900">{{ $product->name }}</h3>
                <p class="text-xs text-gray-400 font-mono mt-1">{{ $product->slug }}</p>
                <div class="mt-4 flex flex-wrap items-center justify-center gap-2">
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                    </span>
                    @if($product->category)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-200">
                        {{ $product->category->name }}
                    </span>
                    @endif
                    @if($product->subcategory)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-50 text-purple-700 border border-purple-200">
                        {{ $product->subcategory->name }}
                    </span>
                    @endif
                </div>
            </div>

            {{-- Timestamps Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-3">
                <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Timestamps</h4>
                <div class="flex justify-between text-xs text-gray-600">
                    <span>Created At</span>
                    <span class="font-medium text-gray-900">{{ $product->created_at->format('M d, Y h:i A') }}</span>
                </div>
                <div class="flex justify-between text-xs text-gray-600">
                    <span>Last Updated</span>
                    <span class="font-medium text-gray-900">{{ $product->updated_at->format('M d, Y h:i A') }}</span>
                </div>
            </div>
        </div>

        {{-- Right: Pricing, Categories & Description --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Pricing Highlights --}}
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg shadow-indigo-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <p class="text-indigo-100 text-xs uppercase tracking-wider font-semibold">Current Price</p>
                        @if ($product->discount_value > 0)
                        <div class="flex items-baseline gap-3 mt-1">
                            <span class="text-4xl font-extrabold">{{ number_format($product->new_price, 2) }} BDT</span>
                            <span class="text-lg text-indigo-200 line-through">{{ number_format($product->price, 2) }} BDT</span>
                        </div>
                        <p class="text-xs text-emerald-200 mt-2 font-medium">
                            Discount: {{ $product->discount_type == 'percentage' ? $product->discount_value . '% off' : number_format($product->discount_value, 2) . ' BDT Fixed off' }}
                        </p>
                        @else
                        <div class="text-4xl font-extrabold mt-1">{{ number_format($product->price, 2) }} BDT</div>
                        <p class="text-xs text-indigo-200 mt-2">No discount currently applied.</p>
                        @endif
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-bangladeshi-taka-sign text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            {{-- Hierarchy Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-shapes text-indigo-500 text-base"></i>
                    Category Hierarchy
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Parent Category</p>
                        @if($product->category)
                        <a href="{{ route('admin.categories.show', $product->category) }}"
                            class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">
                            {{ $product->category->name }}
                        </a>
                        @else
                        <span class="text-sm font-medium text-gray-400">N/A</span>
                        @endif
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Subcategory</p>
                        @if($product->subcategory)
                        <a href="{{ route('admin.subcategories.show', $product->subcategory) }}"
                            class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">
                            {{ $product->subcategory->name }}
                        </a>
                        @else
                        <span class="text-sm font-medium text-gray-400">N/A</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Description Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-align-left text-purple-500 text-base"></i>
                    Description
                </h3>
                <div class="text-sm text-gray-700 leading-relaxed bg-gray-50 rounded-xl p-5 border border-gray-100 whitespace-pre-line">
                    {{ $product->description ?: 'No description provided for this product.' }}
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
