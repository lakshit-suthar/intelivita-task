<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Total Users Card -->
            <div onclick="window.location.href='{{ route('admin.users.index') }}'" class="cursor-pointer bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 text-center transition-transform transform hover:scale-105">
                <div class="text-xl font-semibold text-gray-700 dark:text-gray-200">
                    {{ __('Total Users') }}
                </div>
                <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    {{ $totalUsers }}
                </div>
            </div>

            <!-- Total Questions Card -->
            <div onclick="window.location.href='{{ route('admin.questions.index') }}'" class="cursor-pointer bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 text-center transition-transform transform hover:scale-105">
                <div class="text-xl font-semibold text-gray-700 dark:text-gray-200">
                    {{ __('Total Questions') }}
                </div>
                <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    {{ $totalQuestions }}
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .container {
            max-width: 1200px;
        }
        .grid {
            gap: 2rem;
        }
        .rounded-lg {
            border-radius: 1rem;
        }
        .transition-transform {
            transition: transform 0.3s ease-in-out;
        }
        .hover\:scale-105:hover {
            transform: scale(1.05);
        }
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
</x-admin-app-layout>
