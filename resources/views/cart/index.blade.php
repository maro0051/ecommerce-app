@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @guest
        <!-- Guest User View -->
        <div class="glass-card p-8 text-center">
            <i class="fas fa-lock text-6xl text-accent mb-4"></i>
            <h2 class="text-2xl font-bold gradient-text mb-2">Login to View Your Cart</h2>
            <p class="text-gray-400 mb-6">Please login or create an account to view and manage your shopping cart</p>
            <div class="flex gap-4 justify-center flex-wrap">
                <button onclick="window.dispatchEvent(new CustomEvent('open-auth-modal'))" 
                        class="btn-primary rounded-lg px-6 py-2">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
                <button onclick="window.dispatchEvent(new CustomEvent('open-auth-modal'))" 
                        class="bg-gray-700 text-white rounded-lg px-6 py-2 hover:bg-gray-600 transition-all">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </button>
            </div>
            <div class="mt-6">
                <a href="{{ route('products.index') }}" class="text-accent hover:text-accent-light transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                </a>
            </div>
        </div>
        @else
        <!-- Authenticated User View -->
        <div class="glass-card p-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold gradient-text">Shopping Cart</h1>
                <p class="text-gray-400 mt-2">Review and manage your items</p>
            </div>
            
            @if($cartItems->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-shopping-cart text-6xl text-gray-600 mb-4 animate-bounce"></i>
                    <p class="text-gray-400 text-lg">Your cart is empty</p>
                    <a href="{{ route('products.index') }}" class="btn-primary inline-block px-6 py-3 rounded-lg mt-4 hover-lift">
                        <i class="fas fa-shopping-cart mr-2"></i> Continue Shopping
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-primary-light/30">
                                <th class="text-left py-3">Product</th>
                                <th class="text-left py-3">Price</th>
                                <th class="text-left py-3">Quantity</th>
                                <th class="text-left py-3">Subtotal</th>
                                <th class="text-left py-3"></th>
                              </td>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr class="border-b border-primary-light/20 hover:bg-primary-light/5 transition-colors">
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            @if($item->product->image_url)
                                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" 
                                                     class="w-16 h-16 object-cover rounded-lg">
                                            @else
                                                <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-image text-gray-600"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-semibold">{{ $item->product->name }}</p>
                                                <p class="text-sm text-gray-400">In Stock: {{ $item->product->stock }}</p>
                                            </div>
                                        </div>
                                      </td>
                                    <td class="py-4">${{ number_format($item->product->price, 2) }}</td>
                                    <td class="py-4">
                                        <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                                   min="1" max="{{ $item->product->stock }}"
                                                   class="w-20 rounded-lg input-glow text-center">
                                            <button type="submit" class="text-accent hover:text-accent-light transition-colors">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                      </td>
                                    <td class="py-4 font-semibold text-accent">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                    <td class="py-4">
                                        <form action="{{ route('cart.remove', $item) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                      </td>
                                  </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t border-primary-light/30">
                                <td colspan="3" class="text-right py-4 font-bold text-lg">Total:</td>
                                <td class="py-4 font-bold text-2xl text-accent">${{ number_format($total, 2) }}</td>
                                <tr>
                              </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="mt-8 flex flex-col lg:flex-row justify-between gap-8">
                    <div class="lg:w-1/2">
                        <a href="{{ route('products.index') }}" class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all inline-flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                        </a>
                    </div>
                    
                    <div class="lg:w-1/2">
                        <div class="glass-card p-6">
                            <h3 class="text-xl font-bold gradient-text mb-4">Checkout Information</h3>
                            
                            <form action="{{ route('checkout') }}" method="POST" id="checkout-form">
                                @csrf
                                
                                <!-- Detailed Address Form Component -->
                                @include('components.detailed-address-form')
                                
                                <div class="mt-6">
                                    <label for="payment_method" class="block text-sm font-medium text-gray-300 mb-2">
                                        <i class="fas fa-credit-card mr-1 text-accent"></i>
                                        Payment Method
                                    </label>
                                    <select name="payment_method" id="payment_method" required class="w-full rounded-lg input-glow">
                                        <option value="cash_on_delivery">💵 Cash on Delivery</option>
                                        <option value="card">💳 Credit Card / Debit Card</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="w-full btn-primary rounded-lg py-3 text-lg font-semibold mt-6">
                                    <i class="fas fa-check-circle mr-2"></i> Place Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @endguest
    </div>
</div>
@endsection