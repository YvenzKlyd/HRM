<x-admin-layout>
    @section('title', 'Booking Details | Hotel Transylvania')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Guest Information</h3>
                        <p>Name: {{ $booking->user->name }}</p>
                        <p>Email: {{ $booking->user->email }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Booking Information</h3>
                        <p>Room: {{ $booking->room->name }}</p>
                        <p>Check-in: {{ $booking->check_in->format('M d, Y') }}</p>
                        <p>Check-out: {{ $booking->check_out->format('M d, Y') }}</p>
                        <p class="font-bold">Total Amount: ${{ number_format($booking->total_price, 2) }}</p>
                        
                        <div class="mt-4">
                            <h4 class="text-md font-medium">Booking Status</h4>
                            <p class="mt-2">
                                <span class="px-2 py-1 text-sm font-semibold rounded-full
                                    @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </p>
                        </div>

                        <div class="mt-4">
                            <h4 class="text-md font-medium">Payment Status</h4>
                            <p class="mt-2">
                                <span class="px-2 py-1 text-sm font-semibold rounded-full
                                    @if($booking->payment_status === 'paid') bg-green-100 text-green-800
                                    @elseif($booking->payment_status === 'failed') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                                @if($booking->isPaid())
                                    <span class="text-sm text-gray-600 ml-2">
                                        via {{ ucfirst($booking->payment_method) }} on {{ $booking->paid_at->format('M d, Y H:i') }}
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Back to Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>