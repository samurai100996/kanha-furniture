@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-3xl font-bold mb-4">Products</h2>
                
                <div class="flex justify-between mb-6">
                    <div class="flex-1">
                        <form method="GET" action="{{ route('products.index') }}" class="flex items-center">
                            <label for="category" class="mr-2">Filter by Category:</label>
                            <select name="category" id="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">All</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->name }}" {{ request('category') == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 disabled:opacity-25 transition">Filter</button>
                        </form>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden relative group hover:shadow-lg transition-shadow duration-300">
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
                        
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $product->name }}</h3>
                            
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
                            
                            <div class="mt-2">
                                @if($product->hasDiscount())
                                <span class="text-lg font-semibold text-gray-900">₹{{ number_format($product->discounted_price, 0) }}</span>
                                <span class="text-sm text-gray-500 line-through ml-2">₹{{ number_format($product->price, 0) }}</span>
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

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
