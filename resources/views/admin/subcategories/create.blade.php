@extends('layouts.admin')

@section('title', 'Create New Subcategory')

@section('content')
<div class="max-w-2xl mx-auto sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-md sm:rounded-lg p-6">

        <form action="{{ route('admin.subcategories.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Parent Category</label>
                <select name="category_id" id="category_id" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Subcategory Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 transition duration-150">
                    Create Subcategory
                </button>
                <a href="{{ route('admin.subcategories.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection