@extends('layouts.front')

@section('meta')
    <meta name="description" content="Welcome to Hotel Transylvania - Your spooky home away from home">
@endsection

@section('title')
    Hotel Transylvania
@endsection

@section('style')
    <link href="https://fonts.googleapis.com/css2?family=Henny+Penny&display=swap" rel="stylesheet">
    <style>
        .hotel-title {
            font-family: 'Henny Penny', cursive;
            font-size: 4.5rem;
            letter-spacing: 3px;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5);
            color:rgb(0, 0, 0);
            text-transform: uppercase;
            font-weight: 400;
            background: linear-gradient(45deg,rgb(0, 0, 0),rgb(0, 0, 0));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.5));
        }
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
            transition: all 0.3s ease;
        }
        .feature-tag:hover {
            background-color: #e5e7eb;
            transform: scale(1.05);
        }
        .price-tag {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin: 1rem 0;
        }
        .carousel {
            position: relative;
            width: 100%;
            height: 600px;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .carousel-inner {
            width: 100%;
            height: 100%;
            position: relative;
        }
        .carousel-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .carousel-item.active {
            opacity: 1;
        }
        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .carousel-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 1rem;
            text-align: center;
        }
        .carousel-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 1rem;
            cursor: pointer;
            border: none;
            z-index: 10;
            font-size: 1.5rem;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        .carousel-control:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: translateY(-50%) scale(1.1);
        }
        .carousel-control.prev {
            left: 20px;
        }
        .carousel-control.next {
            right: 20px;
        }
        .room-card {
            transition: transform 0.3s ease;
        }
        .room-card:hover {
            transform: translateY(-5px);
        }
        .amenities-list {
            display: none;
            margin-top: 1rem;
            padding: 1rem;
            background: #f9fafb;
            border-radius: 0.5rem;
        }
        .room-card:hover .amenities-list {
            display: block;
        }
    </style>
@endsection

@section('content')

        <!-- Hotel Title -->
        <div class="container mx-auto p-4 text-center">
            <h1 class="hotel-title mb-8">HOTEL TRANSYLVANIA</h1>
            <p class="text-xl text-gray-600 mb-12">Experience the most hauntingly beautiful stay of your afterlife.</p>

        <!-- Carousel -->
        <div class="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/carousel 1.png') }}" alt="Hotel View 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/carousel 2.png') }}" alt="Hotel View 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/carousel 3.png') }}" alt="Hotel View 3">
                </div>
            </div>
            <button class="carousel-control prev" onclick="prevSlide()">❮</button>
            <button class="carousel-control next" onclick="nextSlide()">❯</button>
        </div>

        <!-- Room Cards -->
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
                <div class="amenities-list">
                    <h3 class="font-semibold mb-2">Additional Amenities:</h3>
                    <ul class="text-left">
                        <li>• 24/7 Room Service</li>
                        <li>• Smart TV with Netflix</li>
                        <li>• Luxury Bathroom</li>
                        <li>• Room Safe</li>
                    </ul>
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
                <div class="amenities-list">
                    <h3 class="font-semibold mb-2">Additional Amenities:</h3>
                    <ul class="text-left">
                        <li>• Temperature Control</li>
                        <li>• Private Blood Bank</li>
                        <li>• Bat Perch</li>
                        <li>• Gothic Decor</li>
                    </ul>
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
                <div class="amenities-list">
                    <h3 class="font-semibold mb-2">Additional Amenities:</h3>
                    <ul class="text-left">
                        <li>• Ectoplasm Pool</li>
                        <li>• Spirit Communication</li>
                        <li>• Floating Furniture</li>
                        <li>• Haunted Mirror</li>
                    </ul>
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
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-item');
        
        function showSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
        }
        
        function nextSlide() {
            showSlide(currentSlide + 1);
        }
        
        function prevSlide() {
            showSlide(currentSlide - 1);
        }
        
        // Auto-advance slides every 5 seconds
        setInterval(nextSlide, 5000);
    </script>
@endsection
