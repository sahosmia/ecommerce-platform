@extends('layouts.admin')

@section('title', 'Edit Product')

@section('header')
<div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Product: {{ $product->name }}
    </h2>
    <a href="{{ route('admin.products.index') }}"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        Back to Products
    </a>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-md sm:rounded-lg p-6">

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) ==
                            $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="subcategory_id" class="block text-sm font-medium text-gray-700">Subcategory</label>
                    <select name="subcategory_id" id="subcategory_id" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        disabled>
                        <option value="">Select a Category first</option>
                    </select>

                    @error('subcategory_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 mb-4">Pricing</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Regular Price</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="discount_type" class="block text-sm font-medium text-gray-700">Discount Type</label>
                    <select name="discount_type" id="discount_type" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="percentage" {{ old('discount_type', $product->discount_type) == 'percentage' ?
                            'selected' : '' }}>Percentage (%)</option>
                        <option value="fixed" {{ old('discount_type', $product->discount_type) == 'fixed' ? 'selected' :
                            '' }}>Fixed Amount </option>
                    </select>
                    @error('discount_type') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="discount_value" class="block text-sm font-medium text-gray-700">Discount Value
                        (Optional)</label>
                    <input type="number" step="0.01" name="discount_value" id="discount_value"
                        value="{{ old('discount_value', $product->discount_value) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('discount_value') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <h3 class="text-lg font-semibold border-b pb-2 mb-4">Description & Media</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description
                        (Optional)</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Change Product Image (Max
                        2MB)</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror

                    @if($product->image)
                    <p class="mt-3 text-sm text-gray-500">Current Image:</p>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                        class="w-20 h-20 object-cover rounded mt-1 border">
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 transition duration-150">
                    Update Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">
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
        var currentSubcategoryId = "{{ old('subcategory_id', $product->subcategory_id ?? '') }}";

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


        @if(isset($product) || old('category_id'))
            $('#category_id').trigger('change');
        @endif
    });
</script>
@endsection
