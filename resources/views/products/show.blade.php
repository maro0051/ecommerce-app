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
                    
                    <!-- Thumbnail Gallery (if multiple images) -->
                    <div class="flex gap-3">
                        @if($product->image_url)
                            <div class="w-20 h-20 rounded-lg overflow-hidden border-2 border-accent/30 cursor-pointer hover:border-accent transition-all">
                                <img src="{{ $product->image_url }}" alt="Thumbnail" class="w-full h-full object-cover">
                            </div>
                            <div class="w-20 h-20 rounded-lg overflow-hidden border-2 border-primary-light/30 cursor-pointer hover:border-accent transition-all">
                                <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                    <i class="fas fa-image text-2xl text-gray-600"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Product Details Section -->
                <div class="space-y-6">
                    <!-- Product Name -->
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
                    
                    <!-- Price -->
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-bold text-accent">${{ number_format($product->price, 2) }}</span>
                        @if($product->stock > 0)
                            <span class="text-sm text-green-400 flex items-center gap-1">
                                <i class="fas fa-check-circle"></i> In Stock
                            </span>
                        @else
                            <span class="text-sm text-red-400 flex items-center gap-1">
                                <i class="fas fa-times-circle"></i> Out of Stock
                            </span>
                        @endif
                    </div>
                    
                    <!-- Description -->
                    <div class="border-t border-b border-primary-light/30 py-4">
                        <h3 class="font-semibold mb-2 flex items-center gap-2">
                            <i class="fas fa-align-left text-accent"></i>
                            Product Description
                        </h3>
                        <p class="text-gray-300 leading-relaxed">{{ $product->description }}</p>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="space-y-2">
                        <div class="flex justify-between py-2 border-b border-primary-light/20">
                            <span class="text-gray-400">SKU:</span>
                            <span class="font-mono text-sm">#{{ $product->id }}-{{ strtoupper(substr($product->name, 0, 3)) }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-primary-light/20">
                            <span class="text-gray-400">Category:</span>
                            <span>Electronics</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-primary-light/20">
                            <span class="text-gray-400">Availability:</span>
                            @if($product->stock > 0)
                                <span class="text-green-400">{{ $product->stock }} units available</span>
                            @else
                                <span class="text-red-400">Out of Stock</span>
                            @endif
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
                                
                                <div class="flex gap-4">
                                    <button type="submit" class="flex-1 btn-primary rounded-lg py-3 text-lg font-semibold">
                                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                    </button>
                                    <button type="button" class="w-12 h-12 rounded-lg bg-gray-800 hover:bg-gray-700 transition-colors">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                            </form>
                        @else
                            <button disabled class="w-full bg-gray-700 text-gray-400 rounded-lg py-3 text-lg font-semibold cursor-not-allowed flex items-center justify-center gap-2">
                                <i class="fas fa-times-circle"></i> Out of Stock
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
                                    <button onclick="window.dispatchEvent(new CustomEvent('open-auth-modal'))" 
                                            class="flex-1 btn-primary rounded-lg py-2">
                                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                                    </button>
                                    <button onclick="window.dispatchEvent(new CustomEvent('open-auth-modal'))" 
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
        
        <!-- Related Products Section -->
        @php
            $relatedProducts = \App\Models\Product::where('id', '!=', $product->id)
                ->where('stock', '>', 0)
                ->latest()
                ->take(4)
                ->get();
        @endphp
        
        @if($relatedProducts->count() > 0)
        <div class="mt-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold gradient-text">You May Also Like</h2>
                <a href="{{ route('products.index') }}" class="text-accent hover:text-accent-light transition-colors">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <div class="glass-card overflow-hidden group hover-lift">
                    <div class="image-zoom overflow-hidden h-48">
                        @if($related->image_url)
                            <img src="{{ $related->image_url }}" alt="{{ $related->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-gray-600"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-1 line-clamp-1">{{ $related->name }}</h3>
                        <p class="text-accent font-bold text-lg">${{ number_format($related->price, 2) }}</p>
                        <a href="{{ route('products.show', $related) }}" 
                           class="block text-center mt-3 text-sm text-accent hover:text-accent-light transition-colors">
                            View Details <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Reviews Section (Placeholder) -->
        <div class="mt-12 glass-card p-6">
            <h2 class="text-xl font-bold gradient-text mb-4">Customer Reviews</h2>
            <div class="text-center py-8">
                <i class="fas fa-star text-4xl text-gray-600 mb-3"></i>
                <p class="text-gray-400">No reviews yet. Be the first to review this product!</p>
                @auth
                    <button class="mt-3 text-accent hover:text-accent-light transition-colors">
                        Write a Review <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                @else
                    <button onclick="window.dispatchEvent(new CustomEvent('open-auth-modal'))" 
                            class="mt-3 text-accent hover:text-accent-light transition-colors">
                        Login to Write a Review
                    </button>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
function incrementQuantity() {
    let quantityInput = document.getElementById('quantity');
    let currentValue = parseInt(quantityInput.value);
    let maxValue = parseInt(quantityInput.max);
    if (currentValue < maxValue) {
        quantityInput.value = currentValue + 1;
    }
}

function decrementQuantity() {
    let quantityInput = document.getElementById('quantity');
    let currentValue = parseInt(quantityInput.value);
    let minValue = parseInt(quantityInput.min);
    if (currentValue > minValue) {
        quantityInput.value = currentValue - 1;
    }
}
</script>

<style>
/* Additional styles for product page */
.image-zoom {
    position: relative;
    overflow: hidden;
}

.image-zoom img {
    transition: transform 0.5s ease;
}

.image-zoom:hover img {
    transform: scale(1.1);
}

/* Quantity input styling */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    opacity: 1;
    height: 100%;
}

/* Glass card hover effect */
.glass-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Favorite button animation */
.fa-heart {
    transition: all 0.3s ease;
}

.fa-heart:hover {
    transform: scale(1.15);
    color: #ef4444;
}
</style>
@endsection