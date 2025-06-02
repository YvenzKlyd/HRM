<x-admin-layout>
    @section('title', 'Admin Dashboard | Hotel Transylvania')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Quick Stats Section -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-blue-600">Total Bookings</h4>
                            <p class="text-2xl font-bold text-blue-700">{{ $totalBookings ?? 0 }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-green-600">Available Rooms</h4>
                            <p class="text-2xl font-bold text-green-700">{{ $availableRooms ?? 0 }}</p>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-yellow-600">Total Users</h4>
                            <p class="text-2xl font-bold text-yellow-700">{{ $totalUsers ?? 0 }}</p>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-purple-600">Revenue</h4>
                            <p class="text-2xl font-bold text-purple-700">${{ number_format($revenue ?? 0) }}</p>
                        </div>
                    </div>

                    <!-- Management Cards Section -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- User Management Card -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">User Management</h3>
                                <p class="text-gray-600 mb-4">Manage system users, their roles, and permissions.</p>
                                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    Manage Users
                                </a>
                            </div>
                        </div>

                        <!-- Room Management Card -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Room Management</h3>
                                <p class="text-gray-600 mb-4">Manage hotel rooms, their types, and availability.</p>
                                <a href="{{ route('admin.rooms.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    Manage Rooms
                                </a>
                            </div>
                        </div>

                        <!-- Booking Management Card -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Booking Management</h3>
                                <p class="text-gray-600 mb-4">View and manage hotel bookings and reservations.</p>
                                <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    Manage Bookings
                                </a>
                            </div>
                        </div>

                        <!-- Service Management Card -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Service Management</h3>
                                <p class="text-gray-600 mb-4">Manage hotel services and amenities.</p>
                                <a href="{{ route('admin.services.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    Manage Services
                                </a>
                            </div>
                        </div>

                        <!-- Reports Card -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Reports & Analytics</h3>
                                <p class="text-gray-600 mb-4">View detailed reports and analytics.</p>
                                <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    View Reports
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>