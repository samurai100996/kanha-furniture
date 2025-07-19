@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-3xl font-bold mb-4">Search Results</h2>
                @if($query)
                <p class="text-gray-600 mb-6">Showing results for "<strong>{{ $query }}</strong>"</p>
                @endif
                
                @if($products->count() > 0)
                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden product-card">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover product-image">
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
                    {{ $products->appends(['q' => $query])->links() }}
                </div>
                @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0121 12c0-4.411-3.589-8-8-8s-8 3.589-8 8c.001 1.391.353 2.77 1.023 3.986.021.034.05.064.068.098.021.036.049.069.073.103A8.002 8.002 0 0015 20.807M9.172 16.172L6.343 19.343a2.25 2.25 0 01-3.182 0l-.707-.707a2.25 2.25 0 010-3.182L5.636 12.172M16.828 16.172a4 4 0 00-5.656 0M16.828 16.172L19.657 19.01a2.25 2.25 0 003.182 0l.707-.707a2.25 2.25 0 000-3.182L20.364 12.172"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try searching with different keywords.</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Browse All Products
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
