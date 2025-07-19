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
                <div class="group relative bg-white rounded-lg shadow-sm overflow-hidden product-card hover:shadow-lg transition-shadow duration-300">
                    <!-- Best Seller Badge -->
                    @if($loop->index < 2)
                    <div class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-3 py-1 z-10 animate-breathe rounded">
                        {{ $product->discount > 30 ? $product->discount . '% OFF' : 'BEST SELLER' }}
                    </div>
                    @endif
                    
                    <!-- Wishlist Heart -->
                    <button class="absolute top-3 right-3 z-10 w-8 h-8 flex items-center justify-center bg-white rounded-full shadow-md hover:bg-red-50 transition-colors duration-200 wishlist-btn" data-product-id="{{ $product->id }}">
                        <svg class="w-5 h-5 text-gray-400 hover:text-red-500 transition-colors duration-200 wishlist-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>
                    
                    <div class="w-full h-64 bg-gray-200 overflow-hidden">
                        @if($product->image)
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                        </a>
                        @else
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-1">
                            <a href="{{ route('products.show', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h3>
                        
                        <!-- Rating Stars -->
                        <div class="flex items-center mb-2">
                            @php $rating = rand(3, 5); @endphp
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm text-gray-600">{{ rand(1, 50) }} reviews</span>
                        </div>
                        
                        <div class="mt-2 flex items-center">
                            @if($product->hasDiscount())
                            <span class="text-lg font-semibold text-gray-900">₹{{ number_format($product->discounted_price, 0) }}</span>
                            <span class="ml-2 text-sm text-gray-500 line-through">₹{{ number_format($product->price, 0) }}</span>
                            @else
                            <span class="text-lg font-semibold text-gray-900">₹{{ number_format($product->price, 0) }}</span>
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
