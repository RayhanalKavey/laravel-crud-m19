@extends('Layout.app')

@section('content')
<div class="container mx-auto max-w-5xl py-10">
    <h2 class="text-4xl font-extrabold mb-10 text-fuchsia-900 text-center">Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg p-8 space-y-8">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="flex flex-col space-y-2">
            <label for="name" class="text-lg font-medium text-gray-700">Product Name</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" required
                class="bg-gray-50 border-2 border-fuchsia-900 rounded-lg p-4 focus:outline-none focus:ring-4 focus:ring-fuchsia-300">
        </div>

        <!-- Description -->
        <div class="flex flex-col space-y-2">
            <label for="description" class="text-lg font-medium text-gray-700">Description</label>
            <textarea id="description" name="description"
                class="bg-gray-50 border-2 border-fuchsia-900 rounded-lg p-4 focus:outline-none focus:ring-4 focus:ring-fuchsia-300 h-32 resize-none">{{ $product->description }}</textarea>
        </div>

        <!-- Price and Stock -->
        <div class="flex flex-wrap gap-8">
            <!-- Price -->
            <div class="flex-1 flex flex-col space-y-2">
                <label for="price" class="text-lg font-medium text-gray-700">Price</label>
                <input type="number" id="price" name="price" value="{{ $product->price }}" required
                    class="bg-gray-50 border-2 border-fuchsia-900 rounded-lg p-4 focus:outline-none focus:ring-4 focus:ring-fuchsia-300">
            </div>

            <!-- Stock -->
            <div class="flex-1 flex flex-col space-y-2">
                <label for="stock" class="text-lg font-medium text-gray-700">Stock</label>
                <input type="number" id="stock" name="stock" value="{{ $product->stock }}"
                    class="bg-gray-50 border-2 border-fuchsia-900 rounded-lg p-4 focus:outline-none focus:ring-4 focus:ring-fuchsia-300">
            </div>
        </div>

        <!-- Image -->
        <div class="flex flex-col space-y-4">
            <label for="image" class="text-lg font-medium text-gray-700">Product Image</label>
            <input type="file" id="image" name="image"
                class="bg-gray-50 border-2 border-fuchsia-900 rounded-lg p-3 focus:outline-none focus:ring-4 focus:ring-fuchsia-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-fuchsia-900 file:text-white hover:file:bg-fuchsia-800">
            @if($product->image)
                <div class="mt-4">
                    <img src="{{ asset("storage/{$product->image}") }}" alt="Product Image"
                        class="w-48 h-48 object-cover rounded-lg shadow-lg border border-gray-200">
                </div>
            @endif
        </div>

        <!-- Submit Button -->
         <div class="flex justify-between items-center">
         <a href="{{ route('products.index') }}" class="text-sm text-fuchsia-700 hover:underline">← Back</a>
            <button type="submit"
                class="bg-fuchsia-900 text-white text-lg px-8 py-3 rounded-lg shadow-lg hover:bg-fuchsia-800 focus:outline-none focus:ring-4 focus:ring-fuchsia-300 transition">
                Update Product
            </button>
        </div>
    </form>
</div>
@endsection
