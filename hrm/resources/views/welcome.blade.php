@extends('layouts.front')

@section('meta')
    <meta name="description" content="Welcome to Hotel Transylvania - Your spooky home away from home">
@endsection

@section('title')
    Home Page
@endsection

@section('style')
    <style>
        .room-card img {
            height: var(--image-height, 25rem);
            width: 100%;
            object-fit: cover;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }
        .room-features {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }
        .feature-tag {
            background-color: #f3f4f6;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            color: #4b5563;
        }
        .price-tag {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin: 1rem 0;
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto p-4 text-center">
        <h1 class="text-4xl font-bold mb-8">HOTEL TRANSYLVANIA</h1>
        <p class="text-xl text-gray-600 mb-12">Experience the most hauntingly beautiful stay of your afterlife</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Room Card 1 -->
            <div class="bg-white rounded-lg shadow-lg p-6 room-card">
                <img src="{{ asset('images/deluxe.jpg') }}" alt="Deluxe Suite">
                <h2 class="text-2xl font-semibold mt-4">Deluxe Suite</h2>
                <p class="text-gray-600 mt-2">A spacious suite with a king-sized bed and a view of the haunted forest.</p>
                <div class="room-features">
                    <span class="feature-tag">King Bed</span>
                    <span class="feature-tag">Forest View</span>
                    <span class="feature-tag">Mini Bar</span>
                    <span class="feature-tag">Free WiFi</span>
                </div>
                <div class="price-tag">$299/night</div>
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-block bg-black text-white px-4 py-2 mt-4 rounded hover:bg-gray-800">Book Now</a>
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-black text-white px-4 py-2 mt-4 rounded hover:bg-gray-800">Book Now</a>
                @endauth
            </div>

            <!-- Room Card 2 -->
            <div class="bg-white rounded-lg shadow-lg p-6 room-card">
                <img src="{{ asset('images/vampire.jpg') }}" alt="Vampire's Lair">
                <h2 class="text-2xl font-semibold mt-4">Vampire's Lair</h2>
                <p class="text-gray-600 mt-2">A cozy room designed for vampires, complete with a coffin and blackout curtains.</p>
                <div class="room-features">
                    <span class="feature-tag">Coffin Bed</span>
                    <span class="feature-tag">Blackout</span>
                    <span class="feature-tag">Blood Bar</span>
                    <span class="feature-tag">24/7 Service</span>
                </div>
                <div class="price-tag">$399/night</div>
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-block bg-black text-white px-4 py-2 mt-4 rounded hover:bg-gray-800">Book Now</a>
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-black text-white px-4 py-2 mt-4 rounded hover:bg-gray-800">Book Now</a>
                @endauth
            </div>

            <!-- Room Card 3 -->
            <div class="bg-white rounded-lg shadow-lg p-6 room-card">
                <img src="{{ asset('images/chamber.jpg') }}" alt="Ghostly Chamber">
                <h2 class="text-2xl font-semibold mt-4">Ghostly Chamber</h2>
                <p class="text-gray-600 mt-2">A room with a spectral ambiance, perfect for ghosts and spirits.</p>
                <div class="room-features">
                    <span class="feature-tag">Ethereal Bed</span>
                    <span class="feature-tag">Floating</span>
                    <span class="feature-tag">Spirit Bar</span>
                    <span class="feature-tag">Ghost WiFi</span>
                </div>
                <div class="price-tag">$349/night</div>
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-block bg-black text-white px-4 py-2 mt-4 rounded hover:bg-gray-800">Book Now</a>
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-black text-white px-4 py-2 mt-4 rounded hover:bg-gray-800">Book Now</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-semibold">Hotel Transylvania</h3>
                    <p class="text-gray-400 mt-2">123 Spooky Street, Transylvania</p>
                </div>
                <div class="flex space-x-6">
                    <a href="/rooms" class="text-gray-400 hover:text-white transition">Rooms</a>
                    <a href="/about" class="text-gray-400 hover:text-white transition">About</a>
                    <a href="/contact" class="text-gray-400 hover:text-white transition">Contact</a>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Hotel Transylvania. All rights reserved.</p>
            </div>
        </div>
    </footer>
@endsection

@section('script')
    <script>
        // script
    </script>
@endsection
