<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->exists ? __('Edit User') : __('Create User') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg">

                    <div class="p-6">
                        @if (session('success'))
                            <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form id="userForm" method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}">
                            @csrf
                            @if ($user->exists)
                                @method('PUT')
                            @endif

                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                                <input id="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-700 focus:ring-opacity-50 @error('name') border-red-500 @enderror" name="name" value="{{ old('name', $user->name) }}" autofocus>
                                @error('name')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                                <input id="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-700 focus:ring-opacity-50 @error('email') border-red-500 @enderror" name="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            @if (!$user->exists)
                                <div class="mb-4">
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-700 focus:ring-opacity-50 @error('password') border-red-500 @enderror" name="password" required>
                                    @error('password')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Confirm Password') }}</label>
                                    <input id="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-700 focus:ring-opacity-50" name="password_confirmation" required>
                                </div>
                            @endif

                            <div class="flex items-center justify-between mt-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-500 focus:outline-none focus:border-blue-700 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-700 active:bg-blue-600 disabled:opacity-25 transition">{{ $user->exists ? __('Update') : __('Create') }}</button>
                                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-500 focus:outline-none focus:border-gray-700 dark:focus:border-gray-500 focus:ring focus:ring-gray-200 dark:focus:ring-gray-700 active:bg-gray-600 disabled:opacity-25 transition">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>