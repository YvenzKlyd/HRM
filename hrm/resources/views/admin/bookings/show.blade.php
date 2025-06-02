<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Booking Details') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('admin.bookings.edit', $booking) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Edit Booking
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-semibold mb-4">Guest Information</h3>
                            <p class="mb-2"><span class="font-medium">Name:</span> {{ $booking->user->name }}</p>
                            <p class="mb-2"><span class="font-medium">Email:</span> {{ $booking->user->email }}</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-semibold mb-4">Room Information</h3>
                            <p class="mb-2"><span class="font-medium">Room Name:</span> {{ $booking->room->name }}</p>
                            <p class="mb-2"><span class="font-medium">Room Type:</span> {{ $booking->room->type }}</p>
                            <p class="mb-2"><span class="font-medium">Capacity:</span> {{ $booking->room->capacity }} persons</p>
                            <p class="mb-2"><span class="font-medium">Price per Night:</span> ${{ number_format($booking->room->price, 2) }}</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-semibold mb-4">Booking Information</h3>
                            <p class="mb-2"><span class="font-medium">Check-in Date:</span> {{ $booking->check_in_date->format('M d, Y') }}</p>
                            <p class="mb-2"><span class="font-medium">Check-out Date:</span> {{ $booking->check_out_date->format('M d, Y') }}</p>
                            <p class="mb-2"><span class="font-medium">Number of Guests:</span> {{ $booking->guests }}</p>
                            <p class="mb-2"><span class="font-medium">Total Price:</span> ${{ number_format($booking->total_price, 2) }}</p>
                            <p class="mb-2">
                                <span class="font-medium">Status:</span>
                                <span class="px-2 py-1 rounded text-sm
                                    @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </p>
                        </div>

                        @if($booking->special_requests)
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h3 class="text-lg font-semibold mb-4">Special Requests</h3>
                                <p class="text-gray-600">{{ $booking->special_requests }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" 
                                onclick="return confirm('Are you sure you want to delete this booking?')">
                                Delete Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>