@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="glass-card p-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold gradient-text">Admin Dashboard</h1>
                <p class="text-gray-400 mt-2">Welcome back, {{ auth()->user()->name }}!</p>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="glass-card p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Products</p>
                            <p class="text-3xl font-bold text-accent">{{ $totalProducts }}</p>
                        </div>
                        <i class="fas fa-boxes text-4xl text-primary-light opacity-50"></i>
                    </div>
                </div>
                
                <div class="glass-card p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Orders</p>
                            <p class="text-3xl font-bold text-accent">{{ $totalOrders }}</p>
                        </div>
                        <i class="fas fa-shopping-cart text-4xl text-primary-light opacity-50"></i>
                    </div>
                </div>
                
                <div class="glass-card p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Customers</p>
                            <p class="text-3xl font-bold text-accent">{{ $totalCustomers }}</p>
                        </div>
                        <i class="fas fa-users text-4xl text-primary-light opacity-50"></i>
                    </div>
                </div>
                
                <div class="glass-card p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Revenue</p>
                            <p class="text-3xl font-bold text-accent">${{ number_format($totalRevenue, 2) }}</p>
                        </div>
                        <i class="fas fa-dollar-sign text-4xl text-primary-light opacity-50"></i>
                    </div>
                </div>
            </div>
            
            <!-- Pending Orders Alert -->
            @php
                $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
                $processingOrders = \App\Models\Order::where('status', 'processing')->count();
            @endphp
            
            @if($pendingOrders > 0)
                <div class="mb-6 p-4 bg-yellow-500/20 border border-yellow-500 rounded-lg animate-pulse">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
                        <div>
                            <p class="font-semibold text-yellow-400">{{ $pendingOrders }} Pending Order(s)</p>
                            <p class="text-sm text-gray-300">You have {{ $pendingOrders }} order(s) waiting for processing</p>
                        </div>
                        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="ml-auto btn-primary text-sm px-3 py-1">
                            View Orders
                        </a>
                    </div>
                </div>
            @endif
            
            <!-- Quick Actions -->
            <div class="mb-8 flex gap-4 flex-wrap">
                <a href="{{ route('admin.products.create') }}" class="btn-primary rounded-lg inline-flex items-center gap-2">
                    <i class="fas fa-plus-circle mr-2"></i> Add New Product
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn-primary rounded-lg" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                    <i class="fas fa-boxes mr-2"></i> Manage Products
                </a>
                <a href="{{ route('admin.orders.index') }}" class="btn-primary rounded-lg" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                    <i class="fas fa-eye mr-2"></i> View All Orders
                </a>
            </div>
            
            <!-- Recent Orders with Live Updates -->
            <div>
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <i class="fas fa-clock mr-2 text-accent"></i>
                    Recent Orders
                    <span x-data="{ count: {{ $recentOrders->where('status', 'pending')->count() }} }" 
                          x-show="count > 0"
                          class="text-xs bg-red-500 text-white px-2 py-1 rounded-full animate-pulse" 
                          x-text="count + ' new'">
                    </span>
                </h2>
                
                <div class="overflow-x-auto" x-data="orderMonitor()" x-init="startMonitoring()">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-primary-light/10">
                                <th class="px-4 py-2 text-left">Order #</th>
                                <th class="px-4 py-2 text-left">Customer</th>
                                <th class="px-4 py-2 text-left">Amount</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Date</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                              </tr>
                        </thead>
                        <tbody id="recent-orders-table">
                            @foreach($recentOrders as $order)
                                <tr class="border-b border-primary-light/20 hover:bg-primary-light/5 transition-colors order-row" data-order-id="{{ $order->id }}">
                                    <td class="px-4 py-2 font-mono text-sm">{{ $order->order_number }}</td>
                                    <td class="px-4 py-2">{{ $order->full_name ?? $order->user->name }}</td>
                                    <td class="px-4 py-2 text-accent font-semibold">${{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                                            @if($order->status == 'pending') status-badge-pending
                                            @elseif($order->status == 'processing') status-badge-processing
                                            @elseif($order->status == 'completed') status-badge-completed
                                            @else status-badge-cancelled
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-sm">{{ $order->created_at->diffForHumans() }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-accent hover:text-accent-light">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function orderMonitor() {
    return {
        startMonitoring() {
            // Check for new orders every 10 seconds
            setInterval(() => {
                this.checkNewOrders();
            }, 10000);
        },
        
        async checkNewOrders() {
            try {
                const response = await fetch('/admin/notifications/check-new');
                const data = await response.json();
                
                if (data.has_new && data.latest_order) {
                    this.addNewOrderRow(data.latest_order);
                    this.showNotification(data.latest_order.message);
                }
            } catch (error) {
                console.error('Error checking orders:', error);
            }
        },
        
        addNewOrderRow(order) {
            const table = document.getElementById('recent-orders-table');
            const newRow = document.createElement('tr');
            newRow.className = 'border-b border-primary-light/20 bg-accent/5 animate-fade-in';
            newRow.innerHTML = `
                <td class="px-4 py-2 font-mono text-sm">${order.number}</td>
                <td class="px-4 py-2">New Customer</td>
                <td class="px-4 py-2 text-accent font-semibold">$0.00</td>
                <td class="px-4 py-2"><span class="px-2 py-1 rounded-full text-xs font-semibold status-badge-pending">Pending</span></td>
                <td class="px-4 py-2 text-sm">Just now</td>
                <td class="px-4 py-2"><a href="/admin/orders/${order.id}" class="text-accent hover:text-accent-light">View Details</a></td>
            `;
            table.insertBefore(newRow, table.firstChild);
            
            // Remove animation class after animation ends
            setTimeout(() => {
                newRow.classList.remove('animate-fade-in');
            }, 500);
        },
        
        showNotification(message) {
            // Show browser notification if permitted
            if (Notification.permission === 'granted') {
                new Notification('New Order!', {
                    body: message,
                    icon: '/favicon.ico'
                });
            } else if (Notification.permission !== 'denied') {
                Notification.requestPermission();
            }
        }
    };
}

// Request notification permission on page load
if ('Notification' in window) {
    Notification.requestPermission();
}
</script>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out;
}

.status-badge-pending { background: rgba(245, 158, 11, 0.2); color: #f59e0b; }
.status-badge-processing { background: rgba(59, 130, 246, 0.2); color: #3b82f6; }
.status-badge-completed { background: rgba(16, 185, 129, 0.2); color: #10b981; }
.status-badge-cancelled { background: rgba(239, 68, 68, 0.2); color: #ef4444; }
</style>
@endsection