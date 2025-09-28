<aside id="sidebar" class="w-96 bg-gray-800 text-white flex flex-col sidebar-transition min-h-screen">

    {{-- Logo / Branding --}}
    <div class="h-16 flex items-center justify-center border-b border-gray-700">
        <h1 class="text-lg font-semibold">Admin Panel</h1>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 transition">
            <div class="w-6 h-6 mr-3">
                <i class="fa-solid fa-house"></i>
            </div>
            <span>Dashboard</span>
        </a>

        {{-- Categories Dropdown --}}
        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-gray-700 transition">
                <div class="flex items-center">
                    <div class="w-6 h-6 mr-3">
                        <i class="fa-solid fa-table-cells-large"></i>
                    </div>
                    <span>Categories</span>
                </div>
                <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" class="ml-8 space-y-1 mt-1">
                <a href="{{ route('admin.categories.index') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">All Categories</a>
                <a href="{{ route('admin.categories.create') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">Add New Category</a>
                <a href="{{ route('admin.categories.trash') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">All Trushed Categories</a>
            </div>
        </div>

        {{-- Subcategories Dropdown --}}
        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-gray-700 transition">
                <div class="flex items-center">
                    <div class="w-6 h-6 mr-3">
                        <i class="fa-solid fa-sitemap"></i>
                    </div>
                    <span>Subcategories</span>
                </div>
                <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" class="ml-8 space-y-1 mt-1">
                <a href="{{ route('admin.subcategories.index') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">All Subcategories</a>
                <a href="{{ route('admin.subcategories.create') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">Add New Subcategory</a>
                <a href="{{ route('admin.subcategories.trash') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">All Trushed Subcategories</a>
            </div>
        </div>

        {{-- Products Dropdown --}}
        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-gray-700 transition">
                <div class="flex items-center">
                    <div class="w-6 h-6 mr-3">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <span>Products</span>
                </div>
                <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" class="ml-8 space-y-1 mt-1">
                <a href="{{ route('admin.products.index') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">All Products</a>
                <a href="{{ route('admin.products.create') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">Add New</a>
                <a href="{{ route('admin.products.trash') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-600 transition">All Trushed Products</a>
            </div>
        </div>


    </nav>
</aside>
