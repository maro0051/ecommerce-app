@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="glass-card p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold gradient-text">Manage Products</h1>
                    <p class="text-gray-400 mt-2">Create, edit and manage your product inventory</p>
                </div>
                <a href="{{ route('admin.products.create') }}" class="btn-primary rounded-lg inline-flex items-center gap-2">
                    <i class="fas fa-plus-circle"></i>
                    Add New Product
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-primary-light/30">
                            <th class="px-4 py-3 text-left text-sm font-semibold">ID</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Image</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Price</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Stock</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Actions</th>
                          </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="border-b border-primary-light/20 hover:bg-primary-light/5 transition-colors product-row">
                                <td class="px-4 py-3">#{{ $product->id }}</td>
                                <td class="px-4 py-3">
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                             class="w-12 h-12 object-cover rounded-lg hover:scale-110 transition-transform">
                                    @else
                                        <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-600"></i>
                                        </div>
                                    @endif
                                 </td>
                                <td class="px-4 py-3 font-medium">{{ $product->name }}</td>
                                <td class="px-4 py-3 text-accent font-semibold">${{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-3">
                                    @if($product->stock > 10)
                                        <span class="text-green-400">✓ {{ $product->stock }} units</span>
                                    @elseif($product->stock > 0)
                                        <span class="text-yellow-400">⚠ {{ $product->stock }} units</span>
                                    @else
                                        <span class="text-red-400">✗ Out of Stock</span>
                                    @endif
                                 </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs
                                        @if($product->stock > 10) bg-green-500/20 text-green-400
                                        @elseif($product->stock > 0) bg-yellow-500/20 text-yellow-400
                                        @else bg-red-500/20 text-red-400
                                        @endif">
                                        {{ $product->stock > 0 ? 'Active' : 'Inactive' }}
                                    </span>
                                 </td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" 
                                           class="text-blue-400 hover:text-blue-300 transition-colors">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" 
                                              onsubmit="return confirm('Delete this product permanently?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors ml-3">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                 </td>
                             </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .product-row {
        animation: fadeInUp 0.4s ease-out backwards;
    }
    .product-row:nth-child(1) { animation-delay: 0.05s; }
    .product-row:nth-child(2) { animation-delay: 0.1s; }
    .product-row:nth-child(3) { animation-delay: 0.15s; }
    .product-row:nth-child(4) { animation-delay: 0.2s; }
    .product-row:nth-child(5) { animation-delay: 0.25s; }
</style>
@endsection