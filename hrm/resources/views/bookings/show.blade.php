<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header Section -->
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800">Booking Details</h2>
                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                            @if($booking->status === 'confirmed') bg-green-100 text-green-800
                            @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    <!-- Main Content -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <!-- Room Image Section -->
                        @if($booking->room->image)
                            <div class="relative h-64 w-full">
                                <img src="{{ asset('storage/' . $booking->room->image) }}" 
                                     alt="{{ $booking->room->name }}" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                    <h3 class="text-2xl font-bold text-white">{{ $booking->room->name }}</h3>
                                </div>
                            </div>
                        @endif

                        <div class="p-6">
                            <!-- Room Information -->
                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Room Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-600 mb-1">Room Type</p>
                                        <p class="font-medium">{{ $booking->room->type }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-600 mb-1">Capacity</p>
                                        <p class="font-medium">{{ $booking->room->capacity }} persons</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-600 mb-1">Price per Night</p>
                                        <p class="font-medium">${{ number_format($booking->room->price, 2) }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-600 mb-1">Room Description</p>
                                        <p class="font-medium">{{ $booking->room->description }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Information -->
                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Booking Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-600 mb-1">Check-in Date</p>
                                        <p class="font-medium">{{ $booking->check_in_date->format('M d, Y') }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-600 mb-1">Check-out Date</p>
                                        <p class="font-medium">{{ $booking->check_out_date->format('M d, Y') }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-600 mb-1">Number of Guests</p>
                                        <p class="font-medium">{{ $booking->guests }} persons</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-600 mb-1">Total Price</p>
                                        <p class="font-medium text-lg text-indigo-600">${{ number_format($booking->total_price, 2) }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Special Requests -->
                            @if($booking->special_requests)
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Special Requests</h3>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-700">{{ $booking->special_requests }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center mt-8 pt-6 border-t">
                                <a href="{{ route('dashboard') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                    </svg>
                                    Back to Dashboard
                                </a>
                                
                                @if($booking->status === 'pending')
                                    <button class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Cancel Booking
                                    </button>
                                @endif

                                <a href="{{ route('bookings.download', $booking) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Download Receipt
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 