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
                    <div class="bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $product->category->name }}</p>
                            <div class="mt-2">
                                @if($product->hasDiscount())
                                <span class="text-lg font-semibold text-gray-900">${{ number_format($product->discounted_price, 2) }}</span>
                                <span class="text-sm text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                                <span class="bg-green-100 text-green-800 text-xs font-medium ml-2 px-2 py-1 rounded">{{ $product->discount }}% OFF</span>
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

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
