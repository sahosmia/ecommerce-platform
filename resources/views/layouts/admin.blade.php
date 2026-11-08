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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Flash messages
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#4f46e5'
                });
            @endif

            // Global SweetAlert2 delete confirmation for forms with [data-confirm-delete] or class 'delete-form'
            document.addEventListener('submit', function (e) {
                const form = e.target;
                if (!form) return;

                // Check if form should trigger SweetAlert
                const hasConfirmAttr = form.hasAttribute('data-confirm-delete');
                const hasDeleteClass = form.classList.contains('delete-form');
                const isDeleteMethod = form.querySelector('input[name="_method"][value="DELETE"]');

                if ((hasConfirmAttr || hasDeleteClass || isDeleteMethod) && !form.dataset.confirmed) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    const title = form.getAttribute('data-swal-title') || 'Are you sure?';
                    const text = form.getAttribute('data-swal-text') || (
                        form.action.includes('force-delete')
                            ? 'This action CANNOT be undone! The item will be permanently deleted.'
                            : 'This item will be moved to trash.'
                    );
                    const confirmButtonText = form.getAttribute('data-swal-confirm-text') || (
                        form.action.includes('force-delete') ? 'Yes, delete forever!' : 'Yes, move to trash!'
                    );
                    const confirmButtonColor = form.action.includes('force-delete') ? '#dc2626' : '#e11d48';

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: confirmButtonColor,
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: confirmButtonText,
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.dataset.confirmed = 'true';
                            form.submit();
                        }
                    });
                }
            }, true);
        });
    </script>
    @yield('scripts')

    @stack('scripts')
</body>

</html>
