@extends('layouts.admin')

@section('title', 'Trashed Categories')

@section('header')
<div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Trashed Categories
    </h2>
    <a href="{{ route('admin.categories.index') }}"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        Back to Categories
    </a>
</div>
@endsection

@section('content')
<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name / Slug
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($trashedCategories as $category)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                    <div class="text-xs text-gray-500">{{ $category->slug }}</div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <form action="{{ route('admin.categories.restore', $category->id) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="text-green-600 hover:text-green-900">
                            Restore
                        </button>
                    </form>

                    <form action="{{ route('admin.categories.force-delete', $category->id) }}" method="POST" class="inline-block"
                        onsubmit="return confirm('Are you sure you want to permanently delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">
                            Delete Permanently
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="px-6 py-4 text-center text-gray-500">
                    No trashed categories found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $trashedCategories->links() }}
</div>
@endsection