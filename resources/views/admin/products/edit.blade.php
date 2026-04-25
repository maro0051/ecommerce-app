@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="glass-card p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold gradient-text">Edit Product</h1>
                    <p class="text-gray-400 mt-2">Update product information</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-accent transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
            
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-tag mr-1 text-accent"></i> Product Name
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                               class="w-full rounded-lg input-glow">
                        @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-dollar-sign mr-1 text-accent"></i> Price
                        </label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" required
                               class="w-full rounded-lg input-glow">
                        @error('price')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                        <i class="fas fa-align-left mr-1 text-accent"></i> Description
                    </label>
                    <textarea name="description" id="description" rows="5" required
                              class="w-full rounded-lg input-glow">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-boxes mr-1 text-accent"></i> Stock Quantity
                        </label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required
                               class="w-full rounded-lg input-glow">
                        @error('stock')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-image mr-1 text-accent"></i> New Image (Optional)
                        </label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full rounded-lg input-glow file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-accent/20 file:text-accent file:cursor-pointer hover:file:bg-accent/30">
                        <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                        @error('image')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Current Image -->
                @if($product->image_url)
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Current Image</label>
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                             class="w-32 h-32 object-cover rounded-lg border-2 border-accent/30">
                    </div>
                @endif
                
                <!-- New Image Preview -->
                <div id="imagePreview" class="hidden">
                    <label class="block text-sm font-medium text-gray-300 mb-2">New Image Preview</label>
                    <img id="preview" src="#" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2 border-accent/30">
                </div>
                
                <div class="flex justify-end pt-4">
                    <button type="submit" class="btn-primary rounded-lg px-8 py-3 text-lg font-semibold">
                        <i class="fas fa-save mr-2"></i> Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview').src = event.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection