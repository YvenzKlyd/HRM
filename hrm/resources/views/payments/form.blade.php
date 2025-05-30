<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Make Payment
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Booking Summary</h3>
                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <p><span class="font-semibold">Room:</span> {{ $booking->room->name }}</p>
                            <p><span class="font-semibold">Check-in:</span> {{ $booking->check_in->format('M d, Y') }}</p>
                            <p><span class="font-semibold">Check-out:</span> {{ $booking->check_out->format('M d, Y') }}</p>
                            <p class="text-lg font-bold mt-2">Total Amount: ${{ number_format($booking->total_price, 2) }}</p>
                        </div>

                        <form action="{{ route('payments.process', $booking) }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <div>
                                <h4 class="text-md font-medium mb-4">Select Payment Method</h4>
                                
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input type="radio" id="credit_card" name="payment_method" value="credit_card" class="h-4 w-4 text-blue-600" required>
                                        <label for="credit_card" class="ml-3 block text-sm font-medium text-gray-700">
                                            Credit Card
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" class="h-4 w-4 text-blue-600">
                                        <label for="bank_transfer" class="ml-3 block text-sm font-medium text-gray-700">
                                            Bank Transfer
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="radio" id="cash" name="payment_method" value="cash" class="h-4 w-4 text-blue-600">
                                        <label for="cash" class="ml-3 block text-sm font-medium text-gray-700">
                                            Cash Payment
                                        </label>
                                    </div>
                                </div>
                            </div>

                            @error('payment_method')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <div class="flex items-center justify-end mt-6">
                                <a href="{{ route('bookings.show', $booking) }}" 
                                   class="mr-4 text-sm text-gray-600 hover:text-gray-900">
                                    Cancel
                                </a>
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Process Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>