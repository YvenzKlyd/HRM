@extends('layouts.front')

@section('meta')
    <meta name="description" content="about your description">
@endsection

@section('title')
    Home Page
@endsection

@section('style')
    <style>
        /* style */
    </style>
@endsection

@section('content')
    <div class="container mx-auto p-4 text-center">
        <h1 class="text-4xl font-bold mb-8">HOTEL TRANSYLVANIA</h1>

        <style>
            .room-card img {
                height: var(--image-height, 25rem); /* Default height is 16rem (256px) */
                width: 100%;
                object-fit: cover;
                border-top-left-radius: 0.5rem;
                border-top-right-radius: 0.5rem;
            }
        </style>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Room Card 1 -->
            <div class="bg-white rounded-lg shadow-lg p-6 room-card">
                <img src="{{ asset('images/deluxe.jpg') }}" alt="Deluxe Suite">
                <h2 class="text-2xl font-semibold mt-4">Deluxe Suite</h2>
                <p class="text-gray-600 mt-2">A spacious suite with a king-sized bed and a view of the haunted forest.</p>
                <button class="bg-black text-white px-4 py-2 mt-4 rounded hover:bg-gray-800">Book Now</button>
            </div>

            <!-- Room Card 2 -->
            <div class="bg-white rounded-lg shadow-lg p-6 room-card">
                <img src="{{ asset('images/vampire.jpg') }}" alt="Vampire's Lair">
                <h2 class="text-2xl font-semibold mt-4">Vampire's Lair</h2>
                <p class="text-gray-600 mt-2">A cozy room designed for vampires, complete with a coffin and blackout curtains.</p>
                <button class="bg-black text-white px-4 py-2 mt-4 rounded hover:bg-gray-800">Book Now</button>
            </div>

            <!-- Room Card 3 -->
            <div class="bg-white rounded-lg shadow-lg p-6 room-card">
                <img src="{{ asset('images/chamber.jpg') }}" alt="Ghostly Chamber">
                <h2 class="text-2xl font-semibold mt-4">Ghostly Chamber</h2>
                <p class="text-gray-600 mt-2">A room with a spectral ambiance, perfect for ghosts and spirits.</p>
                <button class="bg-black text-white px-4 py-2 mt-4 rounded hover:bg-gray-800">Book Now</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // script
    </script>
@endsection
