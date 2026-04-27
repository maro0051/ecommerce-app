@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-accent transition-colors">
                <i class="fas fa-arrow-left"></i>
                Back to Products
            </a>
        </div>

        <!-- Product Main Card -->
        <div class="glass-card overflow-hidden">
            <div class="grid md:grid-cols-2 gap-8 p-6 md:p-8">
                <!-- Product Image Section -->
                <div class="space-y-4">
                    <div class="image-zoom overflow-hidden rounded-2xl bg-gray-800/50">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        @else
                            <div class="w-full h-96 bg-gray-800 flex items-center justify-center">
                                <i class="fas fa-image text-6xl text-gray-600"></i>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Product Details Section -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold gradient-text mb-2">{{ $product->name }}</h1>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1">
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star-half-alt text-yellow-400"></i>
                            </div>
                            <span class="text-sm text-gray-400">(24 reviews)</span>
                        </div>
                    </div>
                    
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-bold text-accent">${{ number_format($product->price, 2) }}</span>
                        @if($product->stock > 0)
                            <span class="text-sm text-green-400 flex items-center gap-1">
                                <i class="fas fa-check-circle"></i> In Stock ({{ $product->stock }} units)
                            </span>
                        @else
                            <span class="text-sm text-red-400 flex items-center gap-1">
                                <i class="fas fa-times-circle"></i> Out of Stock
                            </span>
                        @endif
                    </div>
                    
                    <div class="border-t border-b border-primary-light/30 py-4">
                        <h3 class="font-semibold mb-2 flex items-center gap-2">
                            <i class="fas fa-align-left text-accent"></i>
                            Product Description
                        </h3>
                        <p class="text-gray-300 leading-relaxed">{{ $product->description }}</p>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between py-2 border-b border-primary-light/20">
                            <span class="text-gray-400">SKU:</span>
                            <span class="font-mono text-sm">#{{ $product->id }}-{{ strtoupper(substr($product->name, 0, 3)) }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-primary-light/20">
                            <span class="text-gray-400">Category:</span>
                            <span>Electronics</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-400">Shipping:</span>
                            <span class="text-accent">Free Delivery</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    @auth
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="flex items-center gap-4">
                                    <div class="flex-1">
                                        <label for="quantity" class="block text-sm font-medium text-gray-300 mb-2">Quantity</label>
                                        <div class="flex items-center gap-3">
                                            <button type="button" onclick="decrementQuantity()" class="w-10 h-10 rounded-lg bg-gray-800 hover:bg-gray-700 transition-colors">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                                   class="w-20 text-center rounded-lg input-glow">
                                            <button type="button" onclick="incrementQuantity()" class="w-10 h-10 rounded-lg bg-gray-800 hover:bg-gray-700 transition-colors">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <span class="text-sm text-gray-400">Available: {{ $product->stock }}</span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="w-full btn-primary rounded-lg py-3 text-lg font-semibold">
                                    <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                </button>
                            </form>
                        @else
                            <button disabled class="w-full bg-gray-700 text-gray-400 rounded-lg py-3 text-lg font-semibold cursor-not-allowed">
                                Out of Stock
                            </button>
                        @endif
                    @else
                        <!-- Login/Register Modal Trigger for Unauthenticated -->
                        <div class="space-y-3">
                            <div class="p-4 bg-accent/10 rounded-lg border border-accent/30">
                                <p class="text-center text-sm mb-3">
                                    <i class="fas fa-lock mr-1 text-accent"></i>
                                    Login or register to purchase this product
                                </p>
                                <div class="flex gap-3">
                                    <button onclick="openAuthModal()" 
                                            class="flex-1 btn-primary rounded-lg py-2">
                                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                                    </button>
                                    <button onclick="openAuthModal()" 
                                            class="flex-1 bg-gray-700 text-white rounded-lg py-2 hover:bg-gray-600 transition-all">
                                        <i class="fas fa-user-plus mr-2"></i> Register
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function incrementQuantity() {
    let input = document.getElementById('quantity');
    let max = parseInt(input.max);
    let val = parseInt(input.value);
    if (val < max) input.value = val + 1;
}
function decrementQuantity() {
    let input = document.getElementById('quantity');
    let min = parseInt(input.min);
    let val = parseInt(input.value);
    if (val > min) input.value = val - 1;
}
</script>
@endsection