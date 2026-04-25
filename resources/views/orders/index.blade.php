@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="glass-card p-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold gradient-text">My Orders</h1>
                <p class="text-gray-400 mt-2">Track and manage your orders</p>
            </div>
            
            @if($orders->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-shopping-bag text-6xl text-gray-600 mb-4 animate-pulse"></i>
                    <p class="text-gray-400 text-lg">You haven't placed any orders yet</p>
                    <a href="{{ route('products.index') }}" class="btn-primary inline-block px-6 py-3 rounded-lg mt-4 hover-lift">
                        <i class="fas fa-shopping-cart mr-2"></i> Start Shopping
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <div class="glass-card p-4 hover-lift transition-all duration-300">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <i class="fas fa-receipt text-accent"></i>
                                        <span class="font-semibold text-lg">Order #{{ $order->order_number }}</span>
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                                            @if($order->status == 'pending') bg-yellow-500/20 text-yellow-400
                                            @elseif($order->status == 'processing') bg-blue-500/20 text-blue-400
                                            @elseif($order->status == 'completed') bg-green-500/20 text-green-400
                                            @else bg-red-500/20 text-red-400
                                            @endif">
                                            <i class="fas fa-circle mr-1 text-[8px]"></i>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-400">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        Placed on {{ $order->created_at->format('F j, Y g:i A') }}
                                    </p>
                                    <p class="text-sm text-gray-400 mt-1">
                                        <i class="fas fa-box mr-1"></i>
                                        {{ $order->items->count() }} item(s)
                                    </p>
                                </div>
                                
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-accent">${{ number_format($order->total_amount, 2) }}</p>
                                    <a href="{{ route('orders.show', $order) }}" 
                                       class="inline-flex items-center gap-2 text-accent hover:text-accent-light transition-colors mt-2 group">
                                        View Details 
                                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection