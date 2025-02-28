<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Room Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $room->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Room Type</label>
                                <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="Deluxe Suite" {{ $room->type == 'Deluxe Suite' ? 'selected' : '' }}>Deluxe Suite</option>
                                    <option value="Vampire's Lair" {{ $room->type == "Vampire's Lair" ? 'selected' : '' }}>Vampire's Lair</option>
                                    <option value="Ghostly Chamber" {{ $room->type == 'Ghostly Chamber' ? 'selected' : '' }}>Ghostly Chamber</option>
                                </select>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $room->description) }}</textarea>
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price per Night</label>
                                <input type="number" name="price" id="price" value="{{ old('price', $room->price) }}" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                                <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $room->capacity) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            @if($room->image)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Current Image</label>
                                    <img src="{{ Storage::url($room->image) }}" alt="{{ $room->name }}" class="mt-2 h-48 w-auto">
                                </div>
                            @endif

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Update Room Image</label>
                                <input type="file" name="image" id="image" class="mt-1 block w-full">
                            </div>

                            <div>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_available" value="1" {{ $room->is_available ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="ml-2">Available for Booking</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end">
                                <a href="{{ route('admin.rooms.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-4">Cancel</a>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Room</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>