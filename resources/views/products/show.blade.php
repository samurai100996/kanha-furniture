@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex flex-col lg:flex-row">
                    <div class="flex-shrink-0 w-full lg:w-1/2">
                        <img src="{{ $product->image ?? 'https://via.placeholder.com/600x600' }}" alt="{{ $product->name }}" class="w-full h-96 lg:h-auto object-cover rounded-md">
                    </div>
                    <div class="flex-1 lg:ml-6">
                        <h2 class="text-3xl font-bold mb-4">{{ $product->name }}</h2>
                        <p class="text-gray-500 mb-4">{{ $product->category->name }}</p>
                        <div class="text-xl font-semibold mb-4">
                            @if($product->hasDiscount())
                            <span class="text-gray-900">
                                ${{ number_format($product->discounted_price, 2) }}
                            </span>
                            <span class="text-sm text-gray-500 line-through">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded">
                                {{ $product->discount }}% OFF
                            </span>
                            @else
                            <span class="text-gray-900">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            @endif
                        </div>
                        <p class="text-gray-700 mb-6">{{ $product->description }}</p>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="w-full lg:w-auto bg-indigo-600 text-white px-6 py-3 rounded-md text-lg font-medium hover:bg-indigo-700 transition-colors duration-200">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <h3 class="text-2xl font-bold mb-4">Related Products</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <div class="bg-white border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                    <a href="{{ route('products.show', $related->slug) }}">
                        <img src="{{ $related->image ?? 'https://via.placeholder.com/300' }}" alt="{{ $related->name }}" class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <h4 class="text-lg font-semibold text-gray-900">
                            <a href="{{ route('products.show', $related->slug) }}">{{ $related->name }}</a>
                        </h4>
                        <p class="text-sm text-gray-500">{{ $related->category->name }}</p>
                        <div class="mt-2">
                            @if($related->hasDiscount())
                            <span class="text-lg font-semibold text-gray-900">
                                ${{ number_format($related->discounted_price, 2) }}
                            </span>
                            <span class="text-sm text-gray-500 line-through">
                                ${{ number_format($related->price, 2) }}
                            </span>
                            <span class="bg-green-100 text-green-800 text-xs font-medium ml-2 px-2 py-1 rounded">
                                {{ $related->discount }}% OFF
                            </span>
                            @else
                            <span class="text-lg font-semibold text-gray-900">
                                ${{ number_format($related->price, 2) }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
