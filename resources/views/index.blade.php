<!-- Display all products with pagination -->
@extends('Layout.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-16">
   <div class="mb-6 flex justify-between items-center">
      <h1 class="text-2xl font-bold">Product List</h1>
      <a href="{{ route('products.create') }}" class=" bg-fuchsia-900 text-white px-4 py-2 rounded hover:bg-fuchsia-800 inline-block">
         Add New Product
      </a>
      
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 border border-green-400 rounded px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    @if($products->isEmpty())
        <div class="text-gray-600">No products available.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded shadow">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $product->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $product->description }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $product->stock ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="px-6 py-4 text-center text-sm font-medium">
                              
                                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a> | 
                                <form action="{{ route('products.delete', $product->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    
</div>
@endsection