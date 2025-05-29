<nav class="bg-white p-4 border-b border-gray-200">
    <div class="container mx-auto flex justify-between items-center">
        <div class="shrink-0 flex items-center">
            <a href="/">
                <img src="{{ asset('images/black.png') }}" class="h-9 w-auto">
            </a>
        </div>
        <div class="flex items-center space-x-6">
            <div class="space-x-4">
                <a href="/" class="text-gray-800 hover:text-gray-600">Home</a>
                <a href="/rooms" class="text-gray-800 hover:text-gray-600">Rooms</a>
                <a href="/about" class="text-gray-800 hover:text-gray-600">About</a>
                <a href="/contact" class="text-gray-800 hover:text-gray-600">Contact</a>
            </div>
            <div class="border-l border-gray-300 pl-6 space-x-4">
                <a href="/login" class="text-gray-800 hover:text-gray-600">Login</a>
                <a href="/register" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-150">Register</a>
            </div>
        </div>
    </div>
</nav>
