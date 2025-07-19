<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
<!-- Top Utility Bar -->
            <div class="bg-gray-800 text-white text-sm">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex justify-between items-center py-2">
                        <div class="flex space-x-4">
                            <a href="#" class="hover:text-gray-300 transition-colors">
                                📞 Customer Care: 1800-123-4567
                            </a>
                            <a href="#" class="hover:text-gray-300 transition-colors">
                                📍 Store Locator
                            </a>
                        </div>
                        <div class="flex space-x-4">
                            <a href="#" class="hover:text-gray-300 transition-colors">
                                🏪 Franchise Enquiry
                            </a>
                            <a href="#" class="hover:text-gray-300 transition-colors">
                                🛡️ Warranty Registration
                            </a>
                            <a href="#" class="hover:text-gray-300 transition-colors">
                                📦 Track Your Order
                            </a>
                            <a href="#" class="hover:text-gray-300 transition-colors">
                                💬 Live Chat
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Navigation -->
            <nav class="bg-white shadow-lg relative">
                
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">
                                    Kanha Furniture
                                </a>
                            </div>
                            
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium">
                                    Home
                                </a>
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products.*') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium">
                                    Products
                                </a>
                                <!-- Categories Dropdown -->
                                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                                    <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 text-sm font-medium h-16">
                                        Categories
                                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-1 scale-100"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-1 scale-100"
                                         x-transition:leave-end="opacity-0 scale-95"
                                         class="absolute top-full left-0 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50 mt-1">
                                        @php
                                            $navCategories = \App\Models\Category::all();
                                        @endphp
                                        @foreach($navCategories as $category)
                                        <a href="{{ route('products.index', ['category' => $category->name]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                            {{ $category->icon }} {{ $category->name }}
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Search Bar -->
                        <div class="flex items-center relative" x-data="searchData()">
                            <form action="{{ route('products.search') }}" method="GET" class="flex relative">
                                <input 
                                    type="text" 
                                    name="q" 
                                    x-model="query"
                                    @input.debounce.300ms="search()"
                                    @focus="showResults = results.length > 0"
                                    @blur="hideResults()"
                                    placeholder="Search for Chair, Table, Sofa..." 
                                    class="w-80 px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                    value="{{ request()->get('q') }}"
                                >
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                            </form>
                            
                            <!-- Search Dropdown -->
                            <div x-show="showResults" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-1 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-1 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute top-full left-0 w-80 bg-white border border-gray-200 rounded-md shadow-lg z-50 mt-1 search-dropdown"
                                 @click.away="showResults = false">
                                <div x-show="loading" class="p-4 text-center">
                                    <div class="spinner mx-auto"></div>
                                    <span class="text-gray-500 text-sm mt-2">Searching...</span>
                                </div>
                                <div x-show="!loading && results.length === 0" class="p-4 text-center text-gray-500">
                                    No products found
                                </div>
                                <template x-for="product in results" :key="product.id">
                                    <a :href="'/products/' + product.slug" class="flex items-center p-3 hover:bg-gray-50 border-b border-gray-100 last:border-b-0">
                                        <img :src="product.image || 'https://via.placeholder.com/60'" :alt="product.name" class="w-12 h-12 object-cover rounded">
                                        <div class="ml-3 flex-1">
                                            <h4 class="text-sm font-medium text-gray-900" x-text="product.name"></h4>
                                            <p class="text-xs text-gray-500" x-text="product.category"></p>
                                            <p class="text-sm font-semibold text-blue-600" x-text="'$' + product.price"></p>
                                        </div>
                                    </a>
                                </template>
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="flex items-center space-x-4">
                            <!-- Wishlist Icon -->
                            <a href="#" class="relative p-2 text-gray-500 hover:text-gray-700 transition-colors group">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center group-hover:bg-red-600">3</span>
                                <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                    Wishlist
                                </div>
                            </a>
                            
                            <!-- Cart Icon -->
                            <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-500 hover:text-gray-700 transition-colors group">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5M17 21a2 2 0 100-4 2 2 0 000 4zm-8 0a2 2 0 100-4 2 2 0 000 4z"></path>
                                </svg>
                                @php
                                    $cartCount = session()->get('cart') ? array_sum(array_column(session()->get('cart'), 'quantity')) : 0;
                                @endphp
                                @if($cartCount > 0)
                                    <span class="absolute -top-1 -right-1 bg-blue-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center group-hover:bg-blue-600">{{ $cartCount }}</span>
                                @endif
                                <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                    Cart ({{ $cartCount }})
                                </div>
                            </a>
                            
                            @auth
                                <!-- User Account Dropdown -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 p-1">
                                        <span class="sr-only">Open user menu</span>
                                        <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-semibold">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                        <svg class="ml-1 h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    
                                    <div x-show="open" 
                                         @click.away="open = false"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-1 scale-100"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-1 scale-100"
                                         x-transition:leave-end="opacity-0 scale-95"
                                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                                        <div class="py-1">
                                            <div class="px-4 py-2 text-sm text-gray-700 border-b">
                                                <div class="font-medium">{{ auth()->user()->name }}</div>
                                                <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                                            </div>
                                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                🏠 Dashboard
                                            </a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                📦 My Orders
                                            </a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                ⚙️ Settings
                                            </a>
                                            <div class="border-t">
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                        🚪 Logout
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Login
                                </a>
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    Register
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Mobile menu, show/hide based on menu state -->
                <div class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-indigo-400 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-500' }} text-base font-medium">Home</a>
                        <a href="{{ route('products.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('products.*') ? 'border-indigo-400 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-500' }} text-base font-medium">Products</a>
                        <a href="{{ route('cart.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('cart.*') ? 'border-indigo-400 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-500' }} text-base font-medium">Cart</a>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mx-4 mt-4 rounded relative">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mx-4 mt-4 rounded relative">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                {{ $slot ?? '' }}
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-gray-800 text-white mt-12">
                <div class="max-w-7xl mx-auto py-8 px-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Kanha Furniture</h3>
                            <p class="text-gray-300">Quality furniture for your home and office needs.</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                            <ul class="space-y-2">
                                <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Home</a></li>
                                <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white">Products</a></li>
                                <li><a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white">Cart</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Help</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-300 hover:text-white">About Us</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Contact</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Shipping Info</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                            <p class="text-gray-300">Email: info@kanha-furniture.com</p>
                            <p class="text-gray-300">Phone: (555) 123-4567</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-700 mt-8 pt-6 text-center">
                        <p class="text-gray-300">&copy; {{ date('Y') }} Kanha Furniture. All rights reserved.</p>
                    </div>
                </div>
            </footer>
            
            <!-- Signup Modal -->
            <div x-data="modalData()" x-init="setTimeout(() => open(), 10000)" class="relative">
                <div x-show="isOpen" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-1"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-1"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 z-50 overflow-y-auto">
                    <!-- Modal Backdrop -->
                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="close()"></div>
                        
                        <!-- Modal Content -->
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-transition:enter-end="opacity-1 translate-y-0 sm:scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-1 translate-y-0 sm:scale-100"
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            
                            <!-- Close Button -->
                            <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                            
                            <div class="flex">
                                <!-- Left Side - Image -->
                                <div class="hidden sm:block sm:w-1/2">
                                    <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=400&h=500&fit=crop" alt="Furniture" class="w-full h-full object-cover">
                                </div>
                                
                                <!-- Right Side - Form -->
                                <div class="w-full sm:w-1/2 px-6 py-8">
                                    <div class="text-center mb-6">
                                        <h2 class="text-2xl font-bold text-gray-900 mb-2">WELCOME TO KANHA</h2>
                                        <p class="text-sm text-gray-600 mb-4">Here's Your</p>
                                        <div class="bg-blue-600 text-white px-4 py-2 rounded-lg inline-block mb-4">
                                            <span class="text-xl font-bold">₹500 OFF*</span>
                                        </div>
                                        <p class="text-sm text-gray-600">When you sign-up with us</p>
                                    </div>
                                    
                                    <form class="space-y-4">
                                        <div>
                                            <input type="text" name="first_name" placeholder="FIRST NAME*" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <input type="text" name="last_name" placeholder="LAST NAME*" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <input type="tel" name="phone" placeholder="PHONE NUMBER" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <input type="email" name="email" placeholder="EMAIL ID*" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <input type="password" name="password" placeholder="PASSWORD*" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        
                                        <div class="flex items-start">
                                            <input type="checkbox" id="agree" class="mt-1 mr-2">
                                            <label for="agree" class="text-xs text-gray-600">
                                                I agree to receive promos from Kanha Furniture and accept the 
                                                <a href="#" class="text-blue-600 hover:underline">Terms & Conditions</a>.
                                            </label>
                                        </div>
                                        
                                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                            Sign Up
                                        </button>
                                        
                                        <p class="text-center text-sm text-gray-600">
                                            Already have an account? 
                                            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Sign in</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
