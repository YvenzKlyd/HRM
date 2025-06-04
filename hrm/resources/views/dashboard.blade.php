<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Available Rooms</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($rooms as $room)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                @if($room->image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" class="w-full h-48 object-cover">
                                        <div class="absolute top-2 right-2">
                                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $room->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $room->is_available ? 'Available' : 'Booked' }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="text-xl font-semibold">{{ $room->name }}</h4>
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span class="ml-1 text-gray-600">{{ number_format($room->rating ?? 4.5, 1) }}</span>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 mb-2">{{ $room->type }}</p>
                                    <p class="text-gray-700 mb-4 line-clamp-2">{{ $room->description }}</p>
                                    
                                    <!-- Amenities -->
                                    <div class="mb-4">
                                        <div class="flex flex-wrap gap-2">
                                            @if($room->amenities)
                                                @foreach(json_decode($room->amenities) as $amenity)
                                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-sm rounded-full">
                                                        {{ $amenity }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center mb-4">
                                        <span class="text-lg font-bold text-indigo-600">${{ number_format($room->price, 2) }}/night</span>
                                        <span class="text-sm text-gray-600">Capacity: {{ $room->capacity }} persons</span>
                                    </div>

                                    <div class="mt-4">
                                        <a href="{{ route('rooms.show', $room->id) }}" class="block w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200 text-center">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
