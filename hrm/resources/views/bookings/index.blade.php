<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">My Bookings</h2>
                    </div>

                    @if($bookings->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No bookings found</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by booking a room.</p>
                            <div class="mt-6">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Book a Room
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-6">
                            @foreach($bookings as $booking)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                    <div class="p-6">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">{{ $booking->room->name }}</h3>
                                                <p class="text-sm text-gray-500">{{ $booking->room->type }}</p>
                                            </div>
                                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                                @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800
                                                @endif">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>

                                        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <p class="text-sm text-gray-500">Check-in</p>
                                                <p class="text-sm font-medium">{{ $booking->check_in_date->format('M d, Y') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Check-out</p>
                                                <p class="text-sm font-medium">{{ $booking->check_out_date->format('M d, Y') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Total Price</p>
                                                <p class="text-sm font-medium text-indigo-600">${{ number_format($booking->total_price, 2) }}</p>
                                            </div>
                                        </div>

                                        <div class="mt-6 flex justify-end space-x-3">
                                            <a href="{{ route('bookings.show', $booking) }}" 
                                               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                View Details
                                            </a>
                                            @if($booking->status === 'pending')
                                                <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Cancel Booking
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 