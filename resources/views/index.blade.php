@extends('Layout.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-16">
   <div class="mb-4 flex items-center space-x-4">
      <form action="{{ route('products.index') }}" method="GET" class="flex items-center space-x-4">
         <!-- Sort Field -->
         <label for="sort_field" class="text-sm text-gray-600">Sort By:</label>
         <select name="sort_field" id="sort_field" class="form-select block border border-gray-300 rounded p-2" onchange="this.form.submit()">
               <option value="price" {{ request('sort_field') == 'price' ? 'selected' : '' }}>Price</option>
               <option value="name" {{ request('sort_field') == 'name' ? 'selected' : '' }}>Name</option>
         </select>

         <!-- Sort Order -->
         <label for="sort_order" class="text-sm text-gray-600">Order:</label>
         <select name="sort_order" id="sort_order" class="form-select block border border-gray-300 rounded p-2" onchange="this.form.submit()">
               <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
               <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
         </select>
      </form>
   </div>

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
                               <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 hover:underline">Show</a> | 
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

        @if ($products->hasPages())
         <div class="flex justify-center space-x-2 mt-6">
            <!--  Previous Page Link -->
            @if ($products->onFirstPage())
                  <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Previous</span>
            @else
                  <a href="{{ $products->previousPageUrl() }}" class="px-4 py-2 bg-fuchsia-900 text-white rounded hover:bg-fuchsia-800">Previous</a>
            @endif

            <!-- Pagination Elements  -->
            @foreach ($products->links()->elements[0] as $page => $url)
                  @if ($page == $products->currentPage())
                     <span class="px-4 py-2 bg-fuchsia-800 text-white rounded">{{ $page }}</span>
                  @else
                     <a href="{{ $url }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">{{ $page }}</a>
                  @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($products->hasMorePages())
                  <a href="{{ $products->nextPageUrl() }}" class="px-4 py-2 bg-fuchsia-900 text-white rounded hover:bg-fuchsia-800">Next</a>
            @else
                  <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Next</span>
            @endif
         </div>
     @endif

    @endif
</div>
@endsection