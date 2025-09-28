@extends('layouts.admin')

@section('title', 'Trashed Products')

@section('header')
<div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Trashed Products
    </h2>
    <a href="{{ route('admin.products.index') }}"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        Back to Products
    </a>
</div>
@endsection

@section("content")


<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Image
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name / Slug
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Category
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Price (New/Old)
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($trashedProducts as $product)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                        class="w-12 h-12 object-cover rounded">
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                    <div class="text-xs text-gray-500">{{ $product->slug }}</div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $product->category->name ?? 'N/A' }} / <br>
                    {{ $product->subcategory->name ?? 'N/A' }}
                </td>

                <td class="px-6 py-4 whitespace-nowrap">

                    @if ($product->discount_value > 0)
                    <div class="text-sm font-medium text-gray-600">
                        {{ number_format($product->new_price, 2) }}
                    </div>

                    <div class="text-xs text-red-500 line-through">
                        {{ number_format($product->price, 2) }}
                    </div>

                    @else
                    <div class="text-sm font-medium text-gray-900">
                        {{ number_format($product->price, 2) }}
                    </div>

                    @endif

                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <form action="{{ route('admin.products.restore', $product->id) }}" method="POST"
                        class="inline-block mr-2"
                        onsubmit="return confirm('Are you sure you want to restore this product?');">
                        @csrf
                        <button type="submit" class="text-green-600 hover:text-green-900 font-bold">
                            Restore
                        </button>
                    </form>

                    <form action="{{ route('admin.products.force-delete', $product->id) }}" method="POST"
                        class="inline-block"
                        onsubmit="return confirm('Are you absolutely sure you want to permanently delete this product? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">
                            Permanent Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                    No active products found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $trashedProducts->links() }}
</div>
@endsection
