@extends('layouts.admin')

@section('title', 'Category Details')

@section('header')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-200">
            <i class="fa-solid fa-tag text-white text-lg"></i>
        </div>
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ $category->name }}
            </h2>
            <p class="text-sm text-gray-500">Category details &amp; related items</p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.categories.edit', $category) }}"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium py-2.5 px-4 rounded-xl shadow-sm transition">
            <i class="fa-solid fa-pen-to-square text-sm"></i>
            Edit Category
        </a>
        <a href="{{ route('admin.categories.index') }}"
            class="inline-flex items-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2.5 px-4 rounded-xl shadow-sm transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
            Back to Categories
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

    {{-- Category Info Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-indigo-500 text-base"></i>
                    Category Information
                </h3>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                    Active
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Name</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $category->name }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Slug</p>
                    <p class="text-sm font-mono text-indigo-600 break-all">{{ $category->slug }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Created</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $category->created_at->format('M d, Y') }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Last Updated</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $category->updated_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg shadow-indigo-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-100 text-sm font-medium">Total Subcategories</p>
                    <p class="text-3xl font-bold mt-1">{{ $category->subcategories->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-layer-group text-white text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-6 text-white shadow-lg shadow-emerald-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium">Total Products</p>
                    <p class="text-3xl font-bold mt-1">{{ $category->products->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-box-open text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Subcategories as Tags --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-layer-group text-purple-500 text-base"></i>
                    Subcategories
                </h3>
                <span class="text-xs font-medium text-gray-400">{{ $category->subcategories->count() }} total</span>
            </div>

            @if ($category->subcategories->count() > 0)
            <div class="flex flex-wrap gap-2.5">
                @foreach ($category->subcategories as $subcategory)
                <a href="{{ route('admin.subcategories.show', $subcategory) }}"
                    class="group inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-50 hover:bg-purple-100 border border-purple-200 text-purple-700 text-sm font-medium transition-all hover:shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                    {{ $subcategory->name }}
                    <i class="fa-solid fa-chevron-right text-xs opacity-50 group-hover:opacity-100 group-hover:translate-x-0.5 transition"></i>
                </a>
                @endforeach
            </div>
            @else
            <div class="flex flex-col items-center justify-center py-8 text-center">
                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                    <i class="fa-solid fa-folder-open text-gray-400 text-xl"></i>
                </div>
                <p class="text-sm text-gray-500">No subcategories found for this category.</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Products as Cards --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-box-open text-emerald-500 text-base"></i>
                    Products
                </h3>
                <span class="text-xs font-medium text-gray-400">{{ $category->products->count() }} total</span>
            </div>

            @if ($category->products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($category->products as $product)
                <a href="{{ route('admin.products.show', $product) }}"
                    class="group relative bg-white rounded-xl border border-gray-200 p-5 hover:border-indigo-300 hover:shadow-lg hover:shadow-indigo-100 transition-all duration-200">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                            <i class="fa-solid fa-box text-emerald-600 text-base"></i>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold uppercase tracking-wide bg-indigo-50 text-indigo-600">
                            Product
                        </span>
                    </div>
                    <h4 class="text-sm font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-2">
                        {{ $product->name }}
                    </h4>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xs text-gray-400">View details</span>
                        <span class="w-7 h-7 rounded-full bg-gray-50 group-hover:bg-indigo-500 flex items-center justify-center transition-colors">
                            <i class="fa-solid fa-arrow-right text-xs text-gray-400 group-hover:text-white transition-colors"></i>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="flex flex-col items-center justify-center py-10 text-center">
                <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                    <i class="fa-solid fa-box-open text-gray-400 text-2xl"></i>
                </div>
                <p class="text-sm text-gray-500">No products found for this category.</p>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection
