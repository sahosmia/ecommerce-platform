@extends('layouts.admin')

@section('title', 'Edit Category')

@section('header')
<div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Category: {{ $category->name }}
    </h2>
    <a href="{{ route('admin.categories.index') }}"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        Back to Categories
    </a>
</div>
@endsection

@section('content')
<div class="max-w-2xl mx-auto sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-md sm:rounded-lg p-6">

        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 transition duration-150">
                    Update Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
