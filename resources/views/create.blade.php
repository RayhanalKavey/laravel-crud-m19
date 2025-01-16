<!-- Form to create a new product -->
@extends('Layout.app')

@section('content')
<div class="flex items-center justify-center min-h-screen px-8">
    <div class="max-w-3xl w-full ">
        <h1 class="text-2xl font-bold  mb-4 text-center">Add New Product</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf 
            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter product name" required>
            </div>

            <!-- Description Field -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter product description"></textarea>
            </div>

            <!-- Price Field -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                <input type="number" name="price" id="price" step="0.01" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter product price" required>
            </div>

            <!-- Stock Field -->
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock:</label>
                <input type="number" name="stock" id="stock" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter stock quantity">
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image:</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border file:border-gray-300 file:text-sm file:font-medium file:bg-gray-50 file:text-blue-700 hover:file:bg-gray-100" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between items-center">
                <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:underline">← Back</a>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection