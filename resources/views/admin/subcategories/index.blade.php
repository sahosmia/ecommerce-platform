@extends('layouts.admin')

@section('title', 'Subcategories')

@section('header')
<div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Manage Subcategories
    </h2>
</div>
@endsection

@section('content')
<div class="mb-4 flex gap-2">
    <a href="{{ route('admin.subcategories.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Create Subcategory
    </a>
    <a href="{{ route('admin.subcategories.trash') }}"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
        View Trash
    </a>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name / Slug
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Parent Category
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($subcategories as $subcategory)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $subcategory->name }}</div>
                    <div class="text-xs text-gray-500">{{ $subcategory->slug }}</div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $subcategory->category->name ?? 'N/A' }}
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('admin.subcategories.show', $subcategory) }}"
                        class="text-green-600 hover:text-green-900 mr-3">
                        View
                    </a>

                    <a href="{{ route('admin.subcategories.edit', $subcategory) }}"
                        class="text-indigo-600 hover:text-indigo-900 mr-3">
                        Edit
                    </a>

                    <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST"
                        class="inline-block"
                        onsubmit="return confirm('Are you sure you want to soft delete this subcategory?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                    No active subcategories found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $subcategories->links() }}
</div>
@endsection
