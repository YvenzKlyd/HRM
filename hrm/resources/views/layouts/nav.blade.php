<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="shrink-0 flex items-center">
            <a href="/">
                <img src="{{ asset('images/black.png') }}" class="h-9 w-auto">
            </a>
        </div>
        <div class="flex items-center space-x-6">
            <div class="space-x-4">
                <a href="/" class="text-white hover:text-gray-300">Home</a>
                <a href="/rooms" class="text-white hover:text-gray-300">Rooms</a>
                <a href="/about" class="text-white hover:text-gray-300">About</a>
                <a href="/contact" class="text-white hover:text-gray-300">Contact</a>
            </div>
            <div class="border-l border-gray-600 pl-6 space-x-4">
                <a href="/login" class="text-white hover:text-gray-300">Login</a>
                <a href="/register" class="bg-white text-gray-800 px-4 py-2 rounded-md hover:bg-gray-200 transition duration-150">Register</a>
            </div>
        </div>
    </div>
</nav>
