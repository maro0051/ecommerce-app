@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="glass-card p-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold gradient-text">All Orders</h1>
                <p class="text-gray-400 mt-2">Manage and track customer orders</p>
            </div>
            
            <!-- Stats Summary -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="glass-card p-3 text-center">
                    <p class="text-2xl font-bold text-accent">{{ $orders->total() }}</p>
                    <p class="text-xs text-gray-400">Total Orders</p>
                </div>
                <div class="glass-card p-3 text-center">
                    <p class="text-2xl font-bold text-yellow-400">
                        {{ $orders->where('status', 'pending')->count() }}
                    </p>
                    <p class="text-xs text-gray-400">Pending</p>
                </div>
                <div class="glass-card p-3 text-center">
                    <p class="text-2xl font-bold text-blue-400">
                        {{ $orders->where('status', 'processing')->count() }}
                    </p>
                    <p class="text-xs text-gray-400">Processing</p>
                </div>
                <div class="glass-card p-3 text-center">
                    <p class="text-2xl font-bold text-green-400">
                        {{ $orders->where('status', 'completed')->count() }}
                    </p>
                    <p class="text-xs text-gray-400">Completed</p>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-primary-light/30">
                            <th class="px-4 py-3 text-left">Order #</th>
                            <th class="px-4 py-3 text-left">Customer</th>
                            <th class="px-4 py-3 text-left">Amount</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Payment</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                          </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="border-b border-primary-light/20 hover:bg-primary-light/5 transition-colors">
                                <td class="px-4 py-3 font-mono text-sm">{{ $order->order_number }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-user-circle text-accent"></i>
                                        <div>
                                            <p class="font-medium">{{ $order->user->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $order->user->email }}</p>
                                        </div>
                                    </div>
                                 </td>
                                <td class="px-4 py-3 font-semibold text-accent">${{ number_format($order->total_amount, 2) }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($order->status == 'pending') bg-yellow-500/20 text-yellow-400
                                        @elseif($order->status == 'processing') bg-blue-500/20 text-blue-400
                                        @elseif($order->status == 'completed') bg-green-500/20 text-green-400
                                        @else bg-red-500/20 text-red-400
                                        @endif">
                                        <i class="fas fa-circle mr-1 text-[6px]"></i>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                 </td>
                                <td class="px-4 py-3">
                                    <span class="text-sm">
                                        {{ $order->payment_method == 'cash_on_delivery' ? '💵 COD' : '💳 Card' }}
                                    </span>
                                 </td>
                                <td class="px-4 py-3 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.orders.show', $order) }}" 
                                       class="text-accent hover:text-accent-light transition-colors inline-flex items-center gap-1">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                 </td>
                             </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection