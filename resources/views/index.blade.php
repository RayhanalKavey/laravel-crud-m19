@extends('Layout.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-16">
  
   <div class="container mx-auto max-w-5xl py-10">
    <h2 class="text-4xl font-extrabold mb-10 text-fuchsia-900 text-center">Search Products</h2>
    <input type="text" id="search" placeholder="Search products..."
        class="bg-gray-50 border-2 border-fuchsia-900 rounded-lg p-4 focus:outline-none focus:ring-4 focus:ring-fuchsia-300 w-full">
</div>
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
                <tbody id="productTableBody" class="divide-y divide-gray-200">
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
                                <div class="flex justify-center items-center space-x-4">
                                    <!-- Show Button -->
                                    <a href="{{ route('products.show', $product->id) }}" 
                                    class="bg-fuchsia-100 text-fuchsia-600 px-3 py-1 rounded-md hover:bg-fuchsia-200 hover:text-fuchsia-700 transition">
                                    Show
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('products.edit', $product->id) }}" 
                                    class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-md hover:bg-yellow-200 hover:text-yellow-700 transition">
                                    Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('products.delete', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-100 text-red-600 px-3 py-1 rounded-md hover:bg-red-200 hover:text-red-700 transition"
                                                onclick="return confirm('Are you sure you want to delete this product?');">
                                            Delete
                                        </button>
                                    </form>
                                </div>
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
<script>
//     document.getElementById('search').addEventListener('input', function () {
//     let query = this.value;

//     // যদি ইনপুট ফাঁকা হয়, রেজাল্ট ডিভ ক্লিয়ার করে দিন
//     if (!query) {
//         document.getElementById('searchResults').innerHTML = '';
//         return;
//     }

//     // Ajax রিকোয়েস্ট পাঠানো
//     fetch(`/products/search?query=${query}`)
//         .then(response => response.json())
//         .then(data => {
//             let results = '';
//             if (data.length > 0) {
//                 data.forEach(product => {
//                     results += `
//                         <div class="p-2 border-b border-gray-200">
//                             <h3 class="font-bold text-lg">${product.name}</h3>
//                             <p class="text-gray-600">${product.description || 'No description available'}</p>
//                             <p class="text-fuchsia-700 font-semibold">Price: $${product.price}</p>
//                         </div>
//                     `;
//                 });
//             } else {
//                 results = `<p class="text-gray-500">No products found.</p>`;
//             }
//             document.getElementById('searchResults').innerHTML = results;
//         });
// });
document.getElementById('search').addEventListener('keyup', function () {
    const query = this.value;

    fetch(`/search-products?query=${query}`)
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('productTableBody');
            tableBody.innerHTML = ''; // Clear the current table rows

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7" class="text-center text-gray-500 py-4">No products found.</td></tr>`;
                return;
            }

            data.forEach(product => {
                tableBody.innerHTML += `
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">${product.id}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${product.name}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${product.description}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${parseFloat(product.price).toFixed(2)}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${product.stock || 'N/A'}</td>
                        <td class="px-6 py-4">
                            <img src="/storage/${product.image}" alt="${product.name}" class="w-16 h-16 object-cover rounded">
                        </td>
                        <td class="px-6 py-4 text-center text-sm font-medium">
                            <div class="flex justify-center items-center space-x-4">
                                <a href="/products/${product.id}" class="bg-fuchsia-100 text-fuchsia-600 px-3 py-1 rounded-md hover:bg-fuchsia-200 hover:text-fuchsia-700 transition">Show</a>
                                <a href="/products/${product.id}/edit" class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-md hover:bg-yellow-200 hover:text-yellow-700 transition">Edit</a>
                                <form action="/products/${product.id}" method="POST" class="inline-block">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="bg-red-100 text-red-600 px-3 py-1 rounded-md hover:bg-red-200 hover:text-red-700 transition" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                `;
            });
        });
});

</script>
@endsection