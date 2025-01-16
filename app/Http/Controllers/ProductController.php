<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /* === List All Products === */
    public function getAllProducts(){
        $products = Product::all(); // paginate()
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
        // dd($imagePath);

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

        return view('show');
        $product= Product::find($request->id);
        return response()->json([
            "status"=>true,
            "message"=>"Product found successfully",
            "product"=>$product
        ]) ;
    }

    /* === Show the form to edit a product === */
    public function editProducts(Request $request){
        return view('edit');
        return 'Edit products'." ".$request->id;
    }
    /* === Update a product === */
    public function updateProducts(Request $request){
        if(Product::where('id',$request->id)->update($request->input())){
            return response()->json([
                "status"=>true,
                "message"=>"Product updated successfully",
            ]) ;
        }else{
            return response()->json([
                "status"=>false,
                "message"=>"Failed to update!",
            ]) ;
        }
    }

    /* === Delete a product === */
    public function deleteProducts(Request $request){
        if(Product::where('id',$request->id)->delete()){
            return response()->json([
              "status"=>true,
              "message"=>"Product deleted successfully!",
           ]) ;
        }else{
            return response()->json([
              "status"=>false,
              "message"=>"Failed to deleted!",
           ]) ;
        }
    }
}
