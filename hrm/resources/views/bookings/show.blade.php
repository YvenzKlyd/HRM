<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Room Information</h3>
                        <p>Room: {{ $booking->room->name }}</p>
                        <p>Check-in: {{ $booking->check_in->format('M d, Y') }}</p>
                        <p>Check-out: {{ $booking->check_out->format('M d, Y') }}</p>
                        <p class="font-bold">Total Amount: ${{ number_format($booking->total_price, 2) }}</p>
                        
                        <div class="mt-4">
                            <h4 class="text-md font-medium">Payment Status</h4>
                            <p class="mt-2">
                                @if($booking->isPaid())
                                    <span class="px-2 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                        Paid
                                    </span>
                                    <span class="text-sm text-gray-600 ml-2">
                                        via {{ ucfirst($booking->payment_method) }} on {{ $booking->paid_at->format('M d, Y H:i') }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                        Pending Payment
                                    </span>
                                    <a href="{{ route('payments.form', $booking) }}" 
                                       class="ml-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                        Make Payment
                                    </a>
                                @endif
                            </p>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 