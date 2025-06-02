<nav class="bg-white p-6 border-b border-gray-200 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <div class="shrink-0 flex items-center">
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('images/black.png') }}" class="h-12 w-auto">
            </a>
        </div>
        <div class="flex items-center space-x-8">
            <div class="space-x-6">
                <a href="/" class="text-gray-800 hover:text-gray-600 text-lg font-medium transition duration-150">Home</a>
                <a href="/rooms" class="text-gray-800 hover:text-gray-600 text-lg font-medium transition duration-150">Rooms</a>
                <a href="/about" class="text-gray-800 hover:text-gray-600 text-lg font-medium transition duration-150">About</a>
                <a href="/contact" class="text-gray-800 hover:text-gray-600 text-lg font-medium transition duration-150">Contact</a>
            </div>
            <div class="border-l border-gray-300 pl-8 space-x-6">
                <a href="/login" class="text-gray-800 hover:text-gray-600 text-lg font-medium transition duration-150">Login</a>
                <a href="/register" class="bg-gray-800 text-white px-6 py-3 rounded-md hover:bg-gray-700 transition duration-150 text-lg font-medium">Register</a>
            </div>
        </div>
    </div>
</nav>
