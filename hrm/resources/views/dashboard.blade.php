<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Available Rooms</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($rooms as $room)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" class="w-full h-48 object-cover">
                                @endif
                                <div class="p-4">
                                    <h4 class="text-xl font-semibold mb-2">{{ $room->name }}</h4>
                                    <p class="text-gray-600 mb-2">{{ $room->type }}</p>
                                    <p class="text-gray-700 mb-4">{{ $room->description }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold">${{ number_format($room->price, 2) }}/night</span>
                                        <span class="text-sm text-gray-600">Capacity: {{ $room->capacity }} persons</span>
                                    </div>
                                    @if($room->is_available)
                                        <form action="{{ route('bookings.store') }}" method="POST" class="mt-4">
                                            @csrf
                                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                                            
                                            <div class="mb-4">
                                                <label for="check_in_date" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                                                <input type="date" name="check_in_date" id="check_in_date" required
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>

                                            <div class="mb-4">
                                                <label for="check_out_date" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                                                <input type="date" name="check_out_date" id="check_out_date" required
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>

                                            <div class="mb-4">
                                                <label for="guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                                                <input type="number" name="guests" id="guests" min="1" max="{{ $room->capacity }}" required
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>

                                            <div class="mb-4">
                                                <label for="special_requests" class="block text-sm font-medium text-gray-700">Special Requests (Optional)</label>
                                                <textarea name="special_requests" id="special_requests" rows="2"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                            </div>

                                            <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                Book Now
                                            </button>
                                        </form>
                                    @else
                                        <div class="mt-4 text-center">
                                            <span class="text-red-600 font-semibold">Not Available</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
