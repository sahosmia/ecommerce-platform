@extends('layouts.admin')

@section('title', 'Categories')

@section('header')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-200">
            <i class="fa-solid fa-shapes text-white text-lg"></i>
        </div>
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Manage Categories</h2>
            <p class="text-sm text-gray-500">Organize and manage your product categories</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

    {{-- Action Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex flex-wrap gap-2.5">
            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all duration-200">
                <i class="fa-solid fa-plus text-sm"></i>
                Create Category
            </a>
            <a href="{{ route('admin.categories.trash') }}"
                class="inline-flex items-center gap-2 bg-white border border-red-200 hover:bg-red-50 text-red-600 font-semibold py-2.5 px-5 rounded-xl shadow-sm transition-all duration-200">
                <i class="fa-solid fa-trash text-sm"></i>
                View Trash
            </a>
        </div>

        {{-- Count Badge --}}
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm text-gray-600 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span class="font-semibold text-gray-900">{{ $categories->total() }}</span>
            <span>{{ Str::plural('category', $categories->total()) }} total</span>
        </div>
    </div>

    {{-- Categories List --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        @forelse ($categories as $category)
        <div class="group flex flex-col sm:flex-row sm:items-center gap-4 px-5 sm:px-6 py-4 border-b border-gray-100 last:border-b-0 hover:bg-gray-50/70 transition-colors duration-150">
            {{-- Left: Icon + Info --}}
            <div class="flex items-center gap-4 flex-1 min-w-0">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center shrink-0 group-hover:from-indigo-500 group-hover:to-purple-600 transition-all duration-200">
                    <i class="fa-solid fa-tag text-indigo-600 group-hover:text-white transition-colors duration-200 text-base"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h3 class="text-sm font-semibold text-gray-900 truncate group-hover:text-indigo-600 transition-colors">
                        {{ $category->name }}
                    </h3>
                    <p class="text-xs text-gray-400 font-mono truncate mt-0.5">
                        {{ $category->slug }}
                    </p>
                </div>
            </div>

            {{-- Right: Actions --}}
            <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                <a href="{{ route('admin.categories.show', $category) }}"
                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition-colors"
                    title="View Category">
                    <i class="fa-solid fa-eye text-sm"></i>
                    <span class="hidden sm:inline">View</span>
                </a>

                <a href="{{ route('admin.categories.edit', $category) }}"
                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium text-indigo-700 bg-indigo-50 hover:bg-indigo-100 transition-colors"
                    title="Edit Category">
                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                    <span class="hidden sm:inline">Edit</span>
                </a>

                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block delete-form"
                    data-swal-title="Move Category to Trash?"
                    data-swal-text="Are you sure you want to move '{{ $category->name }}' to trash?"
                    data-swal-confirm-text="Yes, move to trash!">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 transition-colors"
                        title="Move to Trash">
                        <i class="fa-solid fa-trash text-sm"></i>
                        <span class="hidden sm:inline">Delete</span>
                    </button>
                </form>
            </div>
        </div>
        @empty
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center py-16 px-6 text-center">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center mb-4">
                <i class="fa-solid fa-shapes text-indigo-500 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-1">No categories yet</h3>
            <p class="text-sm text-gray-500 mb-5 max-w-sm">Get started by creating your first category to organize your products.</p>
            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-indigo-200 transition-all duration-200">
                <i class="fa-solid fa-plus text-sm"></i>
                Create First Category
            </a>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($categories->hasPages())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-4">
        {{ $categories->links() }}
    </div>
    @endif

</div>
@endsection
