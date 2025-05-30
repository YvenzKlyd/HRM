@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Complete Your Booking</h2>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="room_id" value="{{ request('room_id') }}">

            <div>
                <label for="check_in" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                <input type="date" name="check_in" id="check_in" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('check_in')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="check_out" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                <input type="date" name="check_out" id="check_out" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('check_out')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Complete Booking
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Set minimum date for check-in to tomorrow
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    document.getElementById('check_in').min = tomorrow.toISOString().split('T')[0];

    // Update check-out minimum date when check-in is selected
    document.getElementById('check_in').addEventListener('change', function() {
        const checkInDate = new Date(this.value);
        const nextDay = new Date(checkInDate);
        nextDay.setDate(checkInDate.getDate() + 1);
        document.getElementById('check_out').min = nextDay.toISOString().split('T')[0];
    });
</script>
@endpush
@endsection 