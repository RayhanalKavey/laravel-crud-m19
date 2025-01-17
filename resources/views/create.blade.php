<!-- Form to create a new product -->
@extends('Layout.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100 px-6">
    <div class="max-w-3xl w-full bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-fuchsia-900 mb-8 text-center">Add New Product</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf 
            <!-- Name Field -->
            <div class="flex flex-col">
                <label for="name" class="text-lg font-medium text-gray-700 mb-2">Product Name</label>
                <input type="text" name="name" id="name" class="bg-gray-50 border-2 border-fuchsia-900 rounded-lg p-3 focus:outline-none focus:ring-4 focus:ring-fuchsia-300" placeholder="Enter product name" required>
            </div>

            <!-- Description Field -->
            <div class="flex flex-col">
                <label for="description" class="text-lg font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="4" class="bg-gray-50 border-2 border-fuchsia-900 rounded-lg p-3 focus:outline-none focus:ring-4 focus:ring-fuchsia-300" placeholder="Enter product description"></textarea>
            </div>

            <!-- Price Field -->
            <div class="flex flex-col">
                <label for="price" class="text-lg font-medium text-gray-700 mb-2">Price</label>
                <input type="number" name="price" id="price" step="0.01" class="bg-gray-50 border-2 border-fuchsia-900 rounded-lg p-3 focus:outline-none focus:ring-4 focus:ring-fuchsia-300" placeholder="Enter product price" required>
            </div>

            <!-- Stock Field -->
            <div class="flex flex-col">
                <label for="stock" class="text-lg font-medium text-gray-700 mb-2">Stock</label>
                <input type="number" name="stock" id="stock" class="bg-gray-50 border-2 border-fuchsia-900 rounded-lg p-3 focus:outline-none focus:ring-4 focus:ring-fuchsia-300" placeholder="Enter stock quantity">
            </div>

            <!-- Image Upload -->
            <div class="flex flex-col">
                <label for="image" class="text-lg font-medium text-gray-700 mb-2">Product Image</label>
                <input type="file" name="image" id="image" class="bg-gray-50 border-2 border-fuchsia-900 rounded-lg p-3 focus:outline-none focus:ring-4 focus:ring-fuchsia-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-fuchsia-900 file:text-white hover:file:bg-fuchsia-800" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between items-center">
                <a href="{{ route('products.index') }}" class="text-sm text-fuchsia-700 hover:underline">← Back</a>
                <button type="submit" class="bg-fuchsia-900 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-fuchsia-800 focus:outline-none focus:ring-4 focus:ring-fuchsia-300">
                    Add Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
