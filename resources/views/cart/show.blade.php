{{-- resources/views/products/show.blade.php --}}
@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-image text-6xl text-gray-400"></i>
                        </div>
                    @endif
                </div>
                
                <div class="md:w-1/2 p-8">
                    <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                    <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                    <div class="mb-4">
                        <span class="text-3xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                    </div>
                    <div class="mb-6">
                        <span class="text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock > 0 ? "In Stock: {$product->stock} units" : 'Out of Stock' }}
                        </span>
                    </div>
                    
                    @auth
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex gap-4">
                                @csrf
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                       class="w-24 rounded-md border-gray-300 shadow-sm">
                                <button type="submit" class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
                                    <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                </button>
                            </form>
                        @else
                            <button disabled class="w-full bg-gray-400 text-white px-6 py-3 rounded-md cursor-not-allowed">
                                Out of Stock
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block text-center bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
                            Login to Purchase
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection