<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
/* === List All Products === */
public function getAllProducts(Request $request)
{
    $query = Product::query();

    // Search filter
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('name', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%')
              ->orWhere('id', 'like', '%' . $search . '%') 
              ->orWhere('price', 'like', '%' . $search . '%');
    }

    // Define the default sort order
    $defaultSortOrder = 'asc';

    // Get the sorting field and order from the request
    $sortField = $request->input('sort_field', 'price'); 
    $sortOrder = $request->input('sort_order', 'asc'); 


    // Apply sorting dynamically based on the 'sort_field'
    if ($sortField == 'price') {
        $query->orderBy('price', $sortOrder);
    } elseif ($sortField == 'name') {
        $query->orderBy('name', $sortOrder);
    } else {
        // Default sorting
        $query->orderBy('price', $defaultSortOrder)->orderBy('name', $defaultSortOrder);
    }

    // Paginate the results and append query parameters
    $products = $query->paginate(2)->appends($request->all());
    return view('index', compact('products'));
}


    /* === Show the form to create a new product === */
    public function createProducts(){
        return view('create');
    }

    /* === Store a new product === */
    public function storeProducts(Request $request){
        $request->validate([
            "name"=>"required|string|max:255",
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Store the image in public folder and get the image path
        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
        'product_id' => $request->product_id,
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $imagePath,
         ]);
        
        return redirect()->route('products.index')->with('success','Product created successfully');
    }

    /* === Show a specific product === */
    public function specificProducts(Request $request){
        $product = Product::findOrFail($request->id);
        return view('show',compact('product'));
    }

    /* === Show the form to edit a product === */
    public function editProducts(Request $request){
         $product = Product::findOrFail($request->id);
         return view('edit', compact('product'));
    }

    /* === Update a product === */
    public function updateProducts(Request $request){
         $request->validate([
            "name"=>"required|string|max:255",
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = Product::findOrFail($request->id);

        if ($request->hasFile('image')) {
            // Delete the old image
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Update the product with the new data
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /* === Delete a product === */
    public function deleteProducts(Request $request){
        $product = Product::findOrFail($request->id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        if($product->delete()){
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        }else{
            return redirect()->route('products.index')->with('error', 'Failed to delete the product. Please try again.');
        }
    }
}
