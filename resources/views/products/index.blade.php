@extends('layouts.app')

@section('title', 'All Products')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold gradient-text mb-4">Our Premium Collection</h1>
            <p class="text-gray-400 text-lg">Discover amazing products at great prices</p>
        </div>

        <!-- Search and Filter -->
        <div class="glass-card p-6 mb-8 hover-lift">
            <h2 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-search mr-2 text-accent"></i>
                Search & Filter Products
            </h2>
            <form method="GET" action="{{ route('products.index') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" placeholder="Search products..." 
                           value="{{ request('search') }}"
                           class="w-full rounded-lg input-glow">
                </div>
                <div class="w-32">
                    <input type="number" name="min_price" placeholder="Min Price" 
                           value="{{ request('min_price') }}"
                           class="w-full rounded-lg input-glow">
                </div>
                <div class="w-32">
                    <input type="number" name="max_price" placeholder="Max Price" 
                           value="{{ request('max_price') }}"
                           class="w-full rounded-lg input-glow">
                </div>
                <button type="submit" class="btn-primary rounded-lg">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                @if(request()->anyFilled(['search', 'min_price', 'max_price']))
                    <a href="{{ route('products.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-all">
                        <i class="fas fa-times mr-2"></i>Clear
                    </a>
                @endif
            </form>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $index => $product)
                <div class="glass-card product-card overflow-hidden" style="animation-delay: {{ $index * 0.05 }}s">
                    <div class="image-zoom overflow-hidden">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                 class="w-full h-48 object-cover transition-transform duration-500 hover:scale-110">
                        @else
                            <div class="w-full h-48 bg-gray-800 flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-gray-600"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2 line-clamp-1">{{ $product->name }}</h3>
                        <p class="text-gray-400 text-sm mb-2 line-clamp-2">{{ $product->description }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-2xl font-bold text-accent">${{ number_format($product->price, 2) }}</span>
                            
                            @auth
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-shopping-cart mr-1"></i> Buy Now
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="bg-gray-700 text-gray-400 px-4 py-2 rounded-lg text-sm cursor-not-allowed">
                                        Out of Stock
                                    </button>
                                @endif
                            @else
                                <button onclick="openAuthModal()" 
                                        class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-600 transition-all inline-flex items-center gap-2">
                                    <i class="fas fa-lock"></i> Login to Buy
                                </button>
                            @endauth
                        </div>
                        
                        <div class="mt-3 pt-3 border-t border-primary-light/30">
                            <a href="{{ route('products.show', $product) }}" 
                               class="text-accent hover:text-accent-light text-sm flex items-center justify-center gap-1 transition-colors">
                                View Details <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-box-open text-6xl text-gray-600 mb-4"></i>
                    <p class="text-gray-400 text-lg">No products found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection