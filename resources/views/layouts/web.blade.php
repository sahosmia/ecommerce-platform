<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'eCommerce')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal flex flex-col min-h-screen">

    <header class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div>
                    <a class="text-2xl font-bold text-gray-800 hover:text-gray-700"
                        href="{{ route('home') }}">eCommerce</a>
                </div>
                <div class="flex items-center">
                    <a class="text-gray-600 hover:text-gray-700 mx-4" href="{{ route('home') }}">Home</a>

                    @foreach ($categories as $category)
                    <div class="relative group">
                        <a href="{{ route('category.products', $category->slug) }}"
                            class="text-gray-600 hover:text-gray-700 mx-4 py-2 flex items-center">
                            {{ $category->name }}
                            @if ($category->subcategories->isNotEmpty())
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                            @endif
                        </a>
                        @if ($category->subcategories->isNotEmpty())
                        <div
                            class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20 hidden group-hover:block">
                            @foreach ($category->subcategories as $subcategory)
                            <a href="{{ route('subcategory.products', $subcategory->slug) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $subcategory->name
                                }}</a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach

                    @auth

                    <a class="text-gray-600 hover:text-gray-700 mx-4"
                        href="{{ route('admin.dashboard') }}">Dashboard</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-red-600 hover:text-gray-700 mx-4">
                            Logout
                        </a>
                    </form>
                    @else
                    <a class="text-gray-600 hover:text-gray-700 mx-4" href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow my-8">
        <div class="container mx-auto px-6">
            @yield('content')
        </div>
    </main>

    <footer class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="text-center">
                <p class="text-gray-600">© 2024 eCommerce. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>

</html>
