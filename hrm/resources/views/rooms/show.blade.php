<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800">
                            ← Back to Rooms
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Room Images -->
                        <div class="space-y-4">
                            @if($room->image)
                                <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" 
                                    class="w-full h-96 object-cover rounded-lg shadow-md">
                            @endif
                        </div>

                        <!-- Room Details -->
                        <div class="space-y-6">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">{{ $room->name }}</h1>
                                <p class="text-xl text-gray-600 mt-2">{{ $room->type }}</p>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="ml-1 text-gray-600">{{ number_format($room->rating ?? 4.5, 1) }}</span>
                                </div>
                                <span class="text-gray-600">•</span>
                                <span class="text-gray-600">Capacity: {{ $room->capacity }} persons</span>
                                <span class="text-gray-600">•</span>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $room->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $room->is_available ? 'Available' : 'Booked' }}
                                </span>
                            </div>

                            <div class="prose max-w-none">
                                <h2 class="text-xl font-semibold mb-2">Description</h2>
                                <p class="text-gray-700">{{ $room->description }}</p>
                            </div>

                            @if($room->amenities)
                                <div>
                                    <h2 class="text-xl font-semibold mb-2">Amenities</h2>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(json_decode($room->amenities) as $amenity)
                                            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-sm rounded-full">
                                                {{ $amenity }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="border-t pt-6">
                                <div class="flex justify-between items-center mb-6">
                                    <span class="text-2xl font-bold text-indigo-600">${{ number_format($room->price, 2) }}/night</span>
                                </div>

                                @if($room->is_available)
                                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                                        @csrf
                                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="check_in_date" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                                                <input type="date" name="check_in_date" id="check_in_date" required
                                                    min="{{ date('Y-m-d') }}"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>

                                            <div>
                                                <label for="check_out_date" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                                                <input type="date" name="check_out_date" id="check_out_date" required
                                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                        </div>

                                        <div>
                                            <label for="guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                                            <input type="number" name="guests" id="guests" min="1" max="{{ $room->capacity }}" required
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>

                                        <div>
                                            <label for="special_requests" class="block text-sm font-medium text-gray-700">Special Requests (Optional)</label>
                                            <textarea name="special_requests" id="special_requests" rows="3"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                        </div>

                                        <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                                            Book Now
                                        </button>
                                    </form>
                                @else
                                    <div class="text-center py-4">
                                        <span class="text-red-600 font-semibold">This room is currently not available</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 