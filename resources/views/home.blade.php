@extends('layouts.app')

@section('content')
<div>
    <!-- Hero Carousel -->
    <div x-data="initSwiper()" x-init="init()" class="swiper h-96 relative">
        <div class="swiper-wrapper">
            <!-- Slide 1 - India's Favourite Furniture Sale -->
            <div class="swiper-slide relative">
                <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200&h=400&fit=crop" alt="Furniture Sale">
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-2xl">
                            <div class="bg-blue-600 text-white px-6 py-4 rounded-full inline-block mb-4">
                                <h2 class="text-2xl font-bold">INDIA'S FAVOURITE FURNITURE SALE</h2>
                            </div>
                            <div class="bg-red-600 text-white px-8 py-3 rounded-lg inline-block mb-4">
                                <span class="text-3xl font-bold">Up to 60% Off*</span>
                            </div>
                            <p class="text-white text-lg mb-6">Beds starting from ₹11,900</p>
                            <button class="bg-gray-900 text-white px-8 py-3 rounded font-semibold hover:bg-gray-800 transition-colors">
                                Shop Now ›
                            </button>
                            <p class="text-white text-sm mt-2">*T&C Apply</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 - Living Room Furniture -->
            <div class="swiper-slide relative">
                <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1200&h=400&fit=crop" alt="Living Room">
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-2xl">
                            <h2 class="text-4xl font-bold text-white mb-4">Transform Your Living Room</h2>
                            <p class="text-xl text-gray-300 mb-6">Discover premium sofas, coffee tables, and more</p>
                            <div class="bg-green-600 text-white px-8 py-3 rounded-lg inline-block mb-4">
                                <span class="text-2xl font-bold">Up to 40% Off</span>
                            </div>
                            <br>
                            <button class="bg-blue-600 text-white px-8 py-3 rounded font-semibold hover:bg-blue-700 transition-colors">
                                Explore Collection
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 - Bedroom Collection -->
            <div class="swiper-slide relative">
                <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=1200&h=400&fit=crop" alt="Bedroom">
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-2xl">
                            <h2 class="text-4xl font-bold text-white mb-4">Dream Bedroom Collection</h2>
                            <p class="text-xl text-gray-300 mb-6">Complete bedroom sets starting from ₹15,999</p>
                            <div class="bg-purple-600 text-white px-8 py-3 rounded-lg inline-block mb-4">
                                <span class="text-2xl font-bold">Special Offer</span>
                            </div>
                            <br>
                            <button class="bg-purple-600 text-white px-8 py-3 rounded font-semibold hover:bg-purple-700 transition-colors">
                                Shop Bedroom
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="swiper-pagination"></div>
        
        <!-- Navigation buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Categories Section -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Shop by Category</h2>
                <p class="mt-4 text-lg text-gray-500">Find the perfect furniture for every room in your home</p>
            </div>
            <div class="mt-12 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
                @foreach($categories as $category)
                <div class="group relative">
                    <a href="{{ route('products.index', ['category' => $category->name]) }}" class="block">
                        <div class="w-full bg-gray-200 rounded-lg overflow-hidden aspect-w-1 aspect-h-1 group-hover:opacity-75 transition-opacity duration-200">
                            <div class="w-full h-32 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                <span class="text-4xl">{{ $category->icon }}</span>
                            </div>
                        </div>
                        <h3 class="mt-4 text-sm font-medium text-gray-900 text-center">{{ $category->name }}</h3>
                        <p class="text-xs text-gray-500 text-center">{{ $category->products_count }} products</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Featured Products</h2>
                <p class="mt-4 text-lg text-gray-500">Handpicked items from our latest collection</p>
            </div>
            
            <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($featuredProducts as $product)
                <div class="group relative bg-white rounded-lg shadow-sm overflow-hidden product-card">
                    <div class="w-full h-64 bg-gray-200 overflow-hidden">
                        @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                        @else
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            <a href="{{ route('products.show', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $product->category->name }}</p>
                        <div class="mt-2 flex items-center">
                            @if($product->hasDiscount())
                            <span class="text-lg font-semibold text-gray-900">${{ number_format($product->discounted_price, 2) }}</span>
                            <span class="ml-2 text-sm text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                            <span class="ml-2 bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded">{{ $product->discount }}% OFF</span>
                            @else
                            <span class="text-lg font-semibold text-gray-900">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors duration-200">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-12 text-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white border-indigo-600 hover:bg-indigo-50">
                    View All Products
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
