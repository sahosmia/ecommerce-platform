<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel') . ' | Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

    <style>
        .sidebar-transition {
            transition: width 0.3s ease, min-width 0.3s ease;
        }

        #sidebar.w-20 {
            min-width: 5rem;
            width: 5rem;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main Content --}}
    <div id="main-content" class="flex-1 flex flex-col min-h-screen">

        {{-- Header --}}
        @include('admin.partials.header')

        {{-- Page Header --}}
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-4 px-6 lg:px-8">
                @yield('header')
            </div>
        </header>

        {{-- Main --}}
        <main class="flex-1 p-6 bg-gray-50">
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebar-toggle');

            toggleButton.addEventListener('click', () => {
                sidebar.classList.toggle('w-64');
                sidebar.classList.toggle('w-20');

                // Optional: text hide/show
                sidebar.querySelectorAll('span').forEach(span => {
                    span.classList.toggle('hidden');
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>

</html>
