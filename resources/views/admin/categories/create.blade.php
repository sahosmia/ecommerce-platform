@extends('layouts.admin')

@section('title', 'Create New Category')

@section('header')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-200">
            <i class="fa-solid fa-folder-plus text-white text-lg"></i>
        </div>
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Create Category
            </h2>
            <p class="text-sm text-gray-500">Add a new category to organize your products</p>
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
<div class="max-w-2xl mx-auto sm:px-6 lg:px-8 py-6 space-y-5">

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 sm:px-8 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-emerald-500 text-base"></i>
                Category Details
            </h3>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="p-6 sm:p-8">
            @csrf

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
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        placeholder="e.g. Electronics, Clothing, Books..."
                        class="block w-full pl-11 pr-4 py-2.5 border rounded-xl shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500
                        @error('name') border-red-300 bg-red-50 @else border-gray-300 @enderror">
                </div>
                @error('name')
                <p class="mt-2 text-sm text-red-600 flex items-center gap-1.5">
                    <i class="fa-solid fa-circle-exclamation text-sm"></i>
                    {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Live Slug Preview --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Slug Preview
                </label>
                <div class="flex items-center gap-2 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl">
                    <i class="fa-solid fa-link text-gray-400 text-sm"></i>
                    <span id="slug-preview" class="text-sm font-mono text-gray-400">will-be-generated-from-name</span>
                </div>
                <p class="mt-1.5 text-xs text-gray-400">Auto-generated from the name above.</p>
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-100 -mx-6 sm:-mx-8 my-6"></div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold rounded-xl shadow-lg shadow-emerald-200 hover:shadow-emerald-300 transition-all duration-200">
                    <i class="fa-solid fa-check text-sm"></i>
                    Create Category
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

@push('scripts')
<script>
    const nameInput = document.getElementById('name');
    const slugPreview = document.getElementById('slug-preview');

    function slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    nameInput?.addEventListener('input', () => {
        const value = nameInput.value.trim();
        if (value) {
            slugPreview.textContent = slugify(value);
            slugPreview.classList.remove('text-gray-400');
            slugPreview.classList.add('text-emerald-600');
        } else {
            slugPreview.textContent = 'will-be-generated-from-name';
            slugPreview.classList.remove('text-emerald-600');
            slugPreview.classList.add('text-gray-400');
        }
    });
</script>
@endpush
