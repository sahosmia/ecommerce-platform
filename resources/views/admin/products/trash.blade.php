@extends('layouts.admin')

@section('title', 'Trashed Products')

@section('header')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-red-500 to-rose-600 flex items-center justify-center shadow-lg shadow-red-200">
            <i class="fa-solid fa-trash-can text-white text-lg"></i>
        </div>
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Trashed Products</h2>
            <p class="text-sm text-gray-500">Restore or permanently delete products</p>
        </div>
    </div>
    <a href="{{ route('admin.products.index') }}"
        class="inline-flex items-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2.5 px-4 rounded-xl shadow-sm transition">
        <i class="fa-solid fa-arrow-left text-sm"></i>
        Back to Products
    </a>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

    {{-- Warning Banner --}}
    <div class="flex items-start gap-3 p-4 bg-red-50 border border-red-200 rounded-xl">
        <i class="fa-solid fa-triangle-exclamation text-red-600 text-base shrink-0 mt-0.5"></i>
        <div>
            <p class="text-sm font-medium text-red-900">Permanent deletion warning</p>
            <p class="text-xs text-red-700 mt-0.5">Products in trash can be restored anytime. Permanently deleted products <strong>cannot</strong> be recovered.</p>
        </div>
    </div>

    {{-- Action Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm text-gray-600 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-red-500"></span>
            <span class="font-semibold text-gray-900">{{ $trashedProducts->total() }}</span>
            <span>{{ Str::plural('product', $trashedProducts->total()) }} in trash</span>
        </div>
    </div>

    {{-- Trashed List --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        @forelse ($trashedProducts as $product)
        <div class="group flex flex-col sm:flex-row sm:items-center gap-4 px-5 sm:px-6 py-4 border-b border-gray-100 last:border-b-0 hover:bg-red-50/30 transition-colors duration-150">
            {{-- Left: Image + Info --}}
            <div class="flex items-center gap-4 flex-1 min-w-0">
                <div class="w-14 h-14 rounded-xl bg-gray-100 overflow-hidden shrink-0 border border-gray-200 flex items-center justify-center">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <h3 class="text-sm font-semibold text-gray-900 truncate">
                            {{ $product->name }}
                        </h3>
                        @if($product->category)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium bg-gray-100 text-gray-600">
                            {{ $product->category->name }}
                        </span>
                        @endif
                        @if($product->subcategory)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium bg-gray-100 text-gray-600">
                            {{ $product->subcategory->name }}
                        </span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-400 font-mono truncate mt-0.5">
                        {{ $product->slug }}
                    </p>
                    @if ($product->deleted_at)
                    <p class="text-xs text-red-500 mt-1 flex items-center gap-1">
                        <i class="fa-regular fa-clock text-xs"></i>
                        Deleted {{ $product->deleted_at->diffForHumans() }}
                    </p>
                    @endif
                </div>
            </div>

            {{-- Right: Actions --}}
            <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                {{-- Restore --}}
                <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition-colors"
                        title="Restore Product">
                        <i class="fa-solid fa-rotate-left text-sm"></i>
                        <span class="hidden sm:inline">Restore</span>
                    </button>
                </form>

                {{-- Force Delete --}}
                <form action="{{ route('admin.products.force-delete', $product->id) }}" method="POST" class="inline-block delete-form"
                    data-swal-title="Permanently Delete Product?"
                    data-swal-text="Are you sure you want to permanently delete '{{ $product->name }}'? This action CANNOT be undone."
                    data-swal-confirm-text="Yes, delete forever!">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium text-white bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 shadow-sm hover:shadow-md transition-all"
                        title="Delete Permanently">
                        <i class="fa-solid fa-trash-can text-sm"></i>
                        <span class="hidden sm:inline">Delete Forever</span>
                    </button>
                </form>
            </div>
        </div>
        @empty
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center py-16 px-6 text-center">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center mb-4">
                <i class="fa-solid fa-check text-emerald-500 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-1">Trash is empty</h3>
            <p class="text-sm text-gray-500 mb-5 max-w-sm">Great! There are no deleted products. Everything is clean.</p>
            <a href="{{ route('admin.products.index') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-indigo-200 transition-all duration-200">
                <i class="fa-solid fa-arrow-left text-sm"></i>
                Back to Products
            </a>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($trashedProducts->hasPages())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-4">
        {{ $trashedProducts->links() }}
    </div>
    @endif

</div>
@endsection
