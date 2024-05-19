<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight w-full">
            {{ __('User List') }}
        </h2>
    </x-slot>
    <div class="container mx-auto mt-8">
        <!-- Add User Button -->
        <div class="flex justify-end mt-4 mb-4">
            <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md dark:bg-gray-600 hover:bg-blue-600 dark:hover:bg-gray-700">Add User</a>
        </div>

    <div class="container mx-auto mt-8">
        <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
            <div class="flex items-center">
                <input type="text" name="search" class="form-input rounded-l-md shadow-sm w-full dark:bg-gray-800" placeholder="Search users..." value="{{ request('search') }}" required>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md dark:bg-gray-600 hover:bg-blue-600 dark:hover:bg-gray-700">Search</button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full bg-white dark:bg-gray-700 border divide-y divide-gray-200">
                <thead class="bg-gray-50 dark:bg-gray-600">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-800 uppercase tracking-wider">
                            <a href="{{ route('admin.users.index', ['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                Name
                                @if (request('sort') == 'name')
                                    <i class="fa fa-sort-{{ request('direction') == 'asc' ? 'asc' : 'desc' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-800 uppercase tracking-wider">
                            <a href="{{ route('admin.users.index', ['sort' => 'email', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                Email
                                @if (request('sort') == 'email')
                                    <i class="fa fa-sort-{{ request('direction') == 'asc' ? 'asc' : 'desc' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-800 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    @forelse ($users as $user)
                        <tr class="text-center">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-green-500 hover:text-green-700 dark:text-green-400 dark:hover:text-green-600" title="Edit"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 ml-2 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="3"> No Records Found!</td>
                            </tr>
                        @endforelse
                    
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->appends(request()->input())->links() }}
        </div>
    </div>
</x-admin-app-layout>
