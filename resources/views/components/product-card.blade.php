@props(['product'])

<div class="group relative bg-white rounded-lg shadow-lg overflow-hidden">
    @if ($product->discount_value > 0)
        <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
            @if ($product->discount_type == 'percentage')
                -{{ $product->discount_value }}%
            @else
                -{{ number_format($product->discount_value, 2) }}
            @endif
        </div>
    @endif
    <a href="{{ route('product.details', $product->slug) }}">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
            class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-300">
    </a>
    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-2 truncate group-hover:text-blue-600 transition-colors">
            <a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
        </h2>
        <p class="text-gray-600 mb-2 text-sm">{{ Str::limit($product->description, 40) }}</p>
        <div class="flex items-center justify-between mt-4">
            <div class="flex items-baseline gap-2">
                <span class="text-lg font-bold text-gray-900">{{ number_format($product->new_price, 2) }} BDT</span>
                @if ($product->discount_value > 0)
                    <span
                        class="text-sm text-gray-500 line-through">{{ number_format($product->price, 2) }} BDT</span>
                @endif
            </div>
            <a href="{{ route('product.details', $product->slug) }}"
                class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 text-sm font-semibold">View</a>
        </div>
    </div>
</div>