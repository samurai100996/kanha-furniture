@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-3xl font-bold mb-6">Shopping Cart</h2>
                
                @if(empty($cartItems))
                <div class="text-center py-8">
                    <h3 class="text-lg font-medium text-gray-900">Your cart is empty</h3>
                    <p class="mt-2 text-sm text-gray-500">Start shopping to add items to your cart.</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Continue Shopping
                        </a>
                    </div>
                </div>
                @else
                <div class="flow-root">
                    <ul role="list" class="-my-6 divide-y divide-gray-200">
                        @foreach($cartItems as $id => $item)
                        <li class="flex py-6">
                            <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                <img src="{{ $item['product']->image ?? 'https://via.placeholder.com/100' }}" alt="{{ $item['product']->name }}" class="h-full w-full object-cover object-center">
                            </div>

                            <div class="ml-4 flex flex-1 flex-col">
                                <div>
                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                        <h3>
                                            <a href="{{ route('products.show', $item['product']->slug) }}">{{ $item['product']->name }}</a>
                                        </h3>
                                        <p class="ml-4">${{ number_format($item['subtotal'], 2) }}</p>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">{{ $item['product']->category->name }}</p>
                                    @if($item['product']->hasDiscount())
                                    <p class="mt-1 text-sm text-green-600">{{ $item['product']->discount }}% OFF</p>
                                    @endif
                                </div>
                                <div class="flex flex-1 items-end justify-between text-sm">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <label for="quantity-{{ $id }}" class="mr-2">Qty:</label>
                                        <input type="number" id="quantity-{{ $id }}" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <button type="submit" class="ml-2 text-indigo-600 hover:text-indigo-500">Update</button>
                                    </form>

                                    <div class="flex">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:text-red-500">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                    <div class="flex justify-between text-base font-medium text-gray-900">
                        <p>Subtotal</p>
                        <p>${{ number_format($total, 2) }}</p>
                    </div>
                    <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                    <div class="mt-6">
                        <button class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 w-full">
                            Checkout
                        </button>
                    </div>
                    <div class="mt-6 flex justify-center text-sm text-gray-500">
                        <p>
                            or 
                            <a href="{{ route('products.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Continue Shopping
                                <span aria-hidden="true"> &rarr;</span>
                            </a>
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
