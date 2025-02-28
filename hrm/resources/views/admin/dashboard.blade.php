<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-blue-100 p-6 rounded-lg">
                            <h3 class="text-xl font-bold mb-2">Rooms Management</h3>
                            <p class="mb-4">Manage hotel rooms and their details</p>
                            <a href="{{ route('admin.rooms.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                View Rooms
                            </a>
                        </div>
                        <!-- Add more dashboard cards here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>