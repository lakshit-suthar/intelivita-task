<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
        <script src="{{ asset('admin-assets/js/validation.js') }}"></script>



        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

         <!-- Custom CSS -->
    <style>
        .error {
            color: #ef4444; /* Tailwind red-500 */
            border-color: #ef4444; /* Tailwind red-500 */
        }
        .text-red-500{
            color: #ef4444; /* Tailwind red-500 */
            border-color: #ef4444; /* Tailwind red-500 */
        }
    </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('admin.layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div id="toast-container" class="toast-top-right"></div>

                {{ $slot }}
            </main>
        </div>

        <script>
            window.onload = function() {
                let successMessage = '{{ session("success") }}';
                let errorMessage = '{{ session("error") }}';

                if (successMessage) {
                    toastr.success(successMessage);
                }

                if (errorMessage) {
                    toastr.error(errorMessage);
                }
            };
        </script>
    </body>
</html>
