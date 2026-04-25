@extends('layouts.app')

@section('title', 'Order #' . $order->order_number)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('orders.index') }}" class="text-gray-400 hover:text-accent transition-colors inline-flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Back to Orders
            </a>
        </div>
        
        <!-- Order Header -->
        <div class="glass-card p-6 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-receipt text-2xl text-accent"></i>
                        <h1 class="text-2xl font-bold gradient-text">Order #{{ $order->order_number }}</h1>
                    </div>
                    <p class="text-gray-400">
                        <i class="far fa-calendar-alt mr-1"></i>
                        Placed on {{ $order->created_at->format('F j, Y g:i A') }}
                    </p>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        @if($order->status == 'pending') bg-yellow-500/20 text-yellow-400
                        @elseif($order->status == 'processing') bg-blue-500/20 text-blue-400
                        @elseif($order->status == 'completed') bg-green-500/20 text-green-400
                        @else bg-red-500/20 text-red-400
                        @endif">
                        <i class="fas fa-circle mr-1 text-[8px]"></i>
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <!-- Shipping Information -->
            <div class="glass-card p-6 hover-lift">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-truck text-accent text-xl"></i>
                    <h3 class="font-semibold text-lg">Shipping Information</h3>
                </div>
                <div class="space-y-2 text-gray-300">
                    <p class="flex items-start gap-2">
                        <i class="fas fa-map-marker-alt text-accent mt-1"></i>
                        <span>{{ $order->shipping_address }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fas fa-credit-card text-accent"></i>
                        <span>Payment: {{ str_replace('_', ' ', ucfirst($order->payment_method)) }}</span>
                    </p>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="glass-card p-6 hover-lift">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-chart-line text-accent text-xl"></i>
                    <h3 class="font-semibold text-lg">Order Summary</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Subtotal:</span>
                        <span>${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Shipping:</span>
                        <span class="text-green-400">Free</span>
                    </div>
                    <div class="border-t border-primary-light/30 pt-3 mt-3">
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total:</span>
                            <span class="text-accent text-xl">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Items -->
        <div class="glass-card p-6">
            <div class="flex items-center gap-2 mb-4">
                <i class="fas fa-boxes text-accent text-xl"></i>
                <h3 class="font-semibold text-lg">Order Items</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-primary-light/30">
                            <th class="text-left py-3">Product</th>
                            <th class="text-left py-3">Quantity</th>
                            <th class="text-left py-3">Price</th>
                            <th class="text-left py-3">Total</th>
                          </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr class="border-b border-primary-light/20 hover:bg-primary-light/5 transition-colors">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        @if($item->product->image_url)
                                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" 
                                                 class="w-12 h-12 object-cover rounded-lg">
                                        @else
                                            <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-image text-gray-600"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium">{{ $item->product->name }}</p>
                                            <p class="text-sm text-gray-400">SKU: #{{ $item->product_id }}</p>
                                        </div>
                                    </div>
                                  </td>
                                <td class="py-4">
                                    <span class="inline-flex items-center gap-2">
                                        <i class="fas fa-times text-gray-500 text-sm"></i>
                                        {{ $item->quantity }}
                                    </span>
                                  </td>
                                <td class="py-4">${{ number_format($item->price, 2) }}</td>
                                <td class="py-4 font-semibold text-accent">${{ number_format($item->price * $item->quantity, 2) }}</td>
                              </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-primary-light/30">
                            <td colspan="3" class="text-right py-4 font-bold text-lg">Grand Total:</td>
                            <td class="py-4 font-bold text-2xl text-accent">${{ number_format($order->total_amount, 2) }}</td>
                          </tr>
                    </tfoot>
                </table>
            </div>
            
            <!-- Order Progress Tracker -->
            @if($order->status != 'cancelled')
            <div class="mt-8 pt-6 border-t border-primary-light/30">
                <h4 class="font-semibold mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-simple text-accent"></i>
                    Order Progress
                </h4>
                <div class="flex justify-between items-center">
                    <div class="flex-1 text-center">
                        <div class="w-10 h-10 rounded-full bg-accent/20 border-2 border-accent flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-check text-accent"></i>
                        </div>
                        <p class="text-sm">Order Placed</p>
                        <p class="text-xs text-gray-400">{{ $order->created_at->format('M d') }}</p>
                    </div>
                    <div class="flex-1 h-0.5 bg-primary-light/30 relative">
                        <div class="h-full bg-accent transition-all duration-500" 
                             style="width: {{ $order->status == 'pending' ? '33%' : ($order->status == 'processing' ? '66%' : '100%') }}"></div>
                    </div>
                    <div class="flex-1 text-center">
                        <div class="w-10 h-10 rounded-full {{ $order->status == 'pending' ? 'bg-gray-700 border-2 border-gray-600' : 'bg-accent/20 border-2 border-accent' }} flex items-center justify-center mx-auto mb-2">
                            <i class="fas {{ $order->status == 'pending' ? 'fa-hourglass-half text-gray-500' : 'fa-check text-accent' }}"></i>
                        </div>
                        <p class="text-sm">Processing</p>
                    </div>
                    <div class="flex-1 h-0.5 bg-primary-light/30">
                        <div class="h-full bg-accent transition-all duration-500" 
                             style="width: {{ $order->status == 'completed' ? '100%' : '0%' }}"></div>
                    </div>
                    <div class="flex-1 text-center">
                        <div class="w-10 h-10 rounded-full {{ $order->status == 'completed' ? 'bg-accent/20 border-2 border-accent' : 'bg-gray-700 border-2 border-gray-600' }} flex items-center justify-center mx-auto mb-2">
                            <i class="fas {{ $order->status == 'completed' ? 'fa-check text-accent' : 'fa-gift text-gray-500' }}"></i>
                        </div>
                        <p class="text-sm">Delivered</p>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Download Invoice Button -->
            <div class="mt-6 flex justify-end">
                <button onclick="window.print()" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                    <i class="fas fa-print mr-2"></i>
                    Print Invoice
                </button>
            </div>
        </div>
    </div>
</div>
@endsection