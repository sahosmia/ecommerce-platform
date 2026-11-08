@extends('layouts.admin')

@section('title', 'Create New Product')

@section('header')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-200">
            <i class="fa-solid fa-box-open text-white text-lg"></i>
        </div>
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Create Product</h2>
            <p class="text-sm text-gray-500">Add a new item to your product catalog</p>
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
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-6 space-y-6">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="px-6 sm:px-8 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-emerald-500 text-base"></i>
                Product Information
            </h3>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-8">
            @csrf

            {{-- Basic Details --}}
            <div>
                <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4 text-indigo-600 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                    General Details
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Product Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            placeholder="e.g. Wireless Noise-Cancelling Headphones"
                            class="block w-full px-4 py-2.5 border rounded-xl shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500
                            @error('name') border-red-300 bg-red-50 @else border-gray-300 @enderror">
                        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id" id="category_id" required
                            class="block w-full px-4 py-2.5 border rounded-xl shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500
                            @error('category_id') border-red-300 bg-red-50 @else border-gray-300 @enderror">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="subcategory_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Subcategory <span class="text-red-500">*</span>
                        </label>
                        <select name="subcategory_id" id="subcategory_id" required
                            class="block w-full px-4 py-2.5 border rounded-xl shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 disabled:bg-gray-100 disabled:text-gray-400
                            @error('subcategory_id') border-red-300 bg-red-50 @else border-gray-300 @enderror"
                            disabled>
                            <option value="">Select a Category first</option>
                        </select>
                        @error('subcategory_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Pricing Section --}}
            <div class="border-t border-gray-100 pt-6">
                <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4 text-emerald-600 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                    Pricing &amp; Discounts
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                            Regular Price (BDT) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required
                            placeholder="0.00"
                            class="block w-full px-4 py-2.5 border rounded-xl shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500
                            @error('price') border-red-300 bg-red-50 @else border-gray-300 @enderror">
                        @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="discount_type" class="block text-sm font-semibold text-gray-700 mb-2">
                            Discount Type <span class="text-red-500">*</span>
                        </label>
                        <select name="discount_type" id="discount_type" required
                            class="block w-full px-4 py-2.5 border rounded-xl shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500
                            @error('discount_type') border-red-300 bg-red-50 @else border-gray-300 @enderror">
                            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount (BDT)</option>
                        </select>
                        @error('discount_type') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="discount_value" class="block text-sm font-semibold text-gray-700 mb-2">
                            Discount Value (Optional)
                        </label>
                        <input type="number" step="0.01" name="discount_value" id="discount_value"
                            value="{{ old('discount_value', 0) }}"
                            placeholder="0"
                            class="block w-full px-4 py-2.5 border rounded-xl shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500
                            @error('discount_value') border-red-300 bg-red-50 @else border-gray-300 @enderror">
                        @error('discount_value') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Description & Media --}}
            <div class="border-t border-gray-100 pt-6">
                <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4 text-purple-600 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-purple-600"></span>
                    Description &amp; Media
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Description (Optional)
                        </label>
                        <textarea name="description" id="description" rows="5"
                            placeholder="Enter detailed description of the product..."
                            class="block w-full px-4 py-2.5 border rounded-xl shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500
                            @error('description') border-red-300 bg-red-50 @else border-gray-300 @enderror">{{ old('description') }}</textarea>
                        @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                            Product Image (Max 2MB)
                        </label>
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-emerald-400 transition-colors">
                            <input type="file" name="image" id="image" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-xs text-gray-400 mt-2">PNG, JPG, WEBP up to 2MB</p>
                        </div>
                        @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="border-t border-gray-100 pt-6 flex flex-col sm:flex-row sm:items-center gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold rounded-xl shadow-lg shadow-emerald-200 hover:shadow-emerald-300 transition-all duration-200">
                    <i class="fa-solid fa-check text-sm"></i>
                    Create Product
                </button>
                <a href="{{ route('admin.products.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-xl shadow-sm transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var currentSubcategoryId = "{{ old('subcategory_id') }}";

        $('#category_id').on('change', function () {
            var categoryId = $(this).val();

            if (categoryId) {
                $('#subcategory_id').html('<option value="">Loading...</option>').prop('disabled', true);

                $.ajax({
                    url: '/api/subcategories/' + categoryId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#subcategory_id').empty().prop('disabled', false);
                        $('#subcategory_id').append('<option value="">Select Subcategory</option>');

                        $.each(data, function (key, value) {
                            var selected = (value.id == currentSubcategoryId) ? 'selected' : '';
                            $('#subcategory_id').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                        });

                        currentSubcategoryId = '';
                    },
                    error: function (xhr, status, error) {
                        $('#subcategory_id').empty().prop('disabled', true);
                        $('#subcategory_id').append('<option value="">Error loading subcategories</option>');
                        console.error("AJAX Error: " + error);
                    }
                });
            } else {
                $('#subcategory_id').empty().prop('disabled', true);
                $('#subcategory_id').append('<option value="">Select a Category first</option>');
            }
        });

        @if(old('category_id'))
            $('#category_id').trigger('change');
        @endif
    });
</script>
@endsection
