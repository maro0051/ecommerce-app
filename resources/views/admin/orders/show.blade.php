@extends('layouts.app')

@section('title', 'Order #' . $order->order_number)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('admin.orders.index') }}" class="text-gray-400 hover:text-accent transition-colors inline-flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
        </div>
        
        <div class="glass-card p-6">
            <!-- Order Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 pb-6 border-b border-primary-light/30">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-receipt text-3xl text-accent"></i>
                        <h1 class="text-2xl font-bold gradient-text">Order #{{ $order->order_number }}</h1>
                    </div>
                    <p class="text-gray-400">
                        <i class="far fa-calendar-alt mr-1"></i>
                        Placed on {{ $order->created_at->format('F j, Y g:i A') }}
                    </p>
                </div>
                <div class="flex gap-3">
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
            
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <!-- Customer Information -->
                <div class="glass-card p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <i class="fas fa-user text-accent text-xl"></i>
                        <h3 class="font-semibold text-lg">Customer Information</h3>
                    </div>
                    <div class="space-y-2">
                        <p class="flex items-center gap-2">
                            <i class="fas fa-user-circle text-gray-400 w-5"></i>
                            <span>{{ $order->user->name }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fas fa-envelope text-gray-400 w-5"></i>
                            <span>{{ $order->user->email }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-gray-400 w-5"></i>
                            <span>Member since: {{ $order->user->created_at->format('M d, Y') }}</span>
                        </p>
                    </div>
                </div>
                
                <!-- Shipping Information -->
                <div class="glass-card p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <i class="fas fa-truck text-accent text-xl"></i>
                        <h3 class="font-semibold text-lg">Shipping Information</h3>
                    </div>
                    <div class="space-y-2">
                        <p class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt text-gray-400 w-5 mt-1"></i>
                            <span>{{ $order->shipping_address }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fas fa-credit-card text-gray-400 w-5"></i>
                            <span>Payment: {{ str_replace('_', ' ', ucfirst($order->payment_method)) }}</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Update Status Form -->
            <div class="glass-card p-5 mb-6">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-edit text-accent text-xl"></i>
                    <h3 class="font-semibold text-lg">Update Order Status</h3>
                </div>
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
                    @csrf
                    @method('PUT')
                    <div class="flex-1">
                        <label for="status" class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                        <select name="status" id="status" class="w-full rounded-lg input-glow">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>🟡 Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>🔵 Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>🟢 Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>🔴 Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-primary rounded-lg px-6 py-2">
                        <i class="fas fa-save mr-2"></i> Update Status
                    </button>
                </form>
            </div>
            
            <!-- Order Items -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-boxes text-accent text-xl"></i>
                    <h3 class="font-semibold text-lg">Order Items</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-primary-light/30">
                                <th class="text-left py-3">Product</th>
                                <th class="text-left py-3">SKU</th>
                                <th class="text-left py-3">Quantity</th>
                                <th class="text-left py-3">Unit Price</th>
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
                                            <span class="font-medium">{{ $item->product->name }}</span>
                                        </div>
                                       </td>
                                    <td class="py-4 text-sm text-gray-400">#{{ $item->product_id }}</td>
                                    <td class="py-4">{{ $item->quantity }}</td>
                                    <td class="py-4">${{ number_format($item->price, 2) }}</td>
                                    <td class="py-4 font-semibold text-accent">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                 </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t border-primary-light/30">
                                <td colspan="4" class="text-right py-4 font-bold text-lg">Grand Total:</td>
                                <td class="py-4 font-bold text-2xl text-accent">${{ number_format($order->total_amount, 2) }}</td>
                               </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="mt-6 flex gap-3 justify-end">
                <button onclick="window.print()" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                    <i class="fas fa-print mr-2"></i> Print Order
                </button>
                <a href="{{ route('admin.orders.index') }}" class="bg-accent/20 text-accent px-4 py-2 rounded-lg hover:bg-accent/30 transition-colors">
                    <i class="fas fa-list mr-2"></i> View All Orders
                </a>
            </div>
        </div>
    </div>
</div>
@endsection