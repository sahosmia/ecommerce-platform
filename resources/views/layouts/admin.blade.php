<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel') . ' | Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Configure Toastr options
            if (typeof toastr !== 'undefined') {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                    timeOut: 4000,
                    extendedTimeOut: 1500,
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut'
                };
            }

            // Flash toast notification helper
            const showToast = (type, message) => {
                if (!message) return;
                if (typeof toastr !== 'undefined') {
                    if (type === 'success') toastr.success(message);
                    else if (type === 'error') toastr.error(message);
                    else if (type === 'warning') toastr.warning(message);
                    else toastr.info(message);
                } else if (typeof Swal !== 'undefined') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3500,
                        timerProgressBar: true
                    });
                    Toast.fire({ icon: type, title: message });
                }
            };

            // Flash toast messages from session
            @if(session('success'))
                showToast('success', @json(session('success')));
            @endif

            @if(session('error'))
                showToast('error', @json(session('error')));
            @endif

            @if(session('warning'))
                showToast('warning', @json(session('warning')));
            @endif

            @if(session('info'))
                showToast('info', @json(session('info')));
            @endif

            @if(session('status'))
                showToast('info', @json(session('status')));
            @endif

            @if(session('message'))
                showToast('info', @json(session('message')));
            @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    showToast('error', @json($error));
                @endforeach
            @endif

            // Intercept delete confirmations with SweetAlert2
            const handleConfirmation = (form, event) => {
                if (!form || form.dataset.confirmed === 'true') return;

                const isDeleteMethod = form.querySelector('input[name="_method"][value="DELETE"]');
                const hasConfirmAttr = form.hasAttribute('data-confirm-delete');
                const hasDeleteClass = form.classList.contains('delete-form');

                if (isDeleteMethod || hasConfirmAttr || hasDeleteClass) {
                    if (event) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    const isForceDelete = (form.action && form.action.includes('force-delete')) ||
                        form.classList.contains('force-delete-form') ||
                        form.hasAttribute('data-force-delete');

                    const title = form.getAttribute('data-swal-title') ||
                        (isForceDelete ? 'Permanently Delete Item?' : 'Move to Trash?');
                    const text = form.getAttribute('data-swal-text') || (
                        isForceDelete
                            ? 'This action CANNOT be undone! The item will be permanently deleted.'
                            : 'This item will be moved to trash.'
                    );
                    const confirmButtonText = form.getAttribute('data-swal-confirm-text') || (
                        isForceDelete ? 'Yes, delete forever!' : 'Yes, move to trash!'
                    );
                    const confirmButtonColor = isForceDelete ? '#dc2626' : '#e11d48';

                    if (typeof Swal !== 'undefined') {
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
                    } else if (confirm(text)) {
                        form.dataset.confirmed = 'true';
                        form.submit();
                    }
                }
            };

            // Catch clicks on delete buttons
            document.addEventListener('click', function (e) {
                const btn = e.target.closest('button[type="submit"], input[type="submit"]');
                if (!btn) return;
                const form = btn.closest('form');
                if (form) {
                    handleConfirmation(form, e);
                }
            }, true);

            // Also catch direct form submit events as a fallback
            document.addEventListener('submit', function (e) {
                const form = e.target;
                if (form && form.dataset.confirmed !== 'true') {
                    const isDeleteMethod = form.querySelector('input[name="_method"][value="DELETE"]');
                    const hasConfirmAttr = form.hasAttribute('data-confirm-delete');
                    const hasDeleteClass = form.classList.contains('delete-form');
                    if (isDeleteMethod || hasConfirmAttr || hasDeleteClass) {
                        handleConfirmation(form, e);
                    }
                }
            }, true);
        });
    </script>
    @yield('scripts')

    @stack('scripts')
</body>

</html>
