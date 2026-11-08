@extends('layouts.admin')

@section('title', 'Edit Category')

@section('header')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg shadow-amber-200">
            <i class="fa-solid fa-pen-to-square text-white text-lg"></i>
        </div>
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Edit Category
            </h2>
            <p class="text-sm text-gray-500">
                Updating <span class="font-medium text-gray-700">{{ $category->name }}</span>
            </p>
        </div>
    </div>
    <a href="{{ route('admin.categories.index') }}"
        class="inline-flex items-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2.5 px-4 rounded-xl shadow-sm transition">
        <i class="fa-solid fa-arrow-left text-sm"></i>
        Back to Categories
    </a>
</div>
@endsection

@section('content')
<div class="max-w-2xl mx-auto sm:px-6 lg:px-8 py-6"> 

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 sm:px-8 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-indigo-500 text-base"></i>
                Category Details
            </h3>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="p-6 sm:p-8">
            @csrf
            @method('PUT')

            {{-- Name Field --}}
            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Category Name
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-tag text-sm"></i>
                    </div>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                        class="block w-full pl-11 pr-4 py-2.5 border rounded-xl shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500
                        @error('name') border-red-300 bg-red-50 @else border-gray-300 @enderror">
                </div>
                @error('name')
                <p class="mt-2 text-sm text-red-600 flex items-center gap-1.5">
                    <i class="fa-solid fa-circle-exclamation text-sm"></i>
                    {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Slug Preview (Read-only) --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Current Slug
                </label>
                <div class="flex items-center gap-2 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl">
                    <i class="fa-solid fa-link text-gray-400 text-sm"></i>
                    <span class="text-sm font-mono text-gray-600">{{ $category->slug }}</span>
                </div>
                <p class="mt-1.5 text-xs text-gray-400">Slug is auto-generated and will update with the name.</p>
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-100 -mx-6 sm:-mx-8 my-6"></div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all duration-200">
                    <i class="fa-solid fa-check text-sm"></i>
                    Update Category
                </button>
                <a href="{{ route('admin.categories.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-xl shadow-sm transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
