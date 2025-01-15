<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /* === List All Products === */
    public function getAllProducts(){
        $products= Product::get();
        return response()->json([
            "status"=>true,
            "message"=>"Product found successfully",
            "products"=>$products
        ]) ;
    }

    /* === Show the form to create a new product === */
    public function createProducts(){
        return 'Create products';
    }

    /* === Store a new product === */
    public function storeProducts(Request $request){
        return response()->json([
            "status"=>true,
            "message"=>"Product created successfully",
            "products"=>Product::create($request->input())
        ]) ;
    }

    /* === Show a specific product === */
    public function specificProducts(Request $request){
        $product= Product::find($request->id);
        return response()->json([
            "status"=>true,
            "message"=>"Product found successfully",
            "product"=>$product
        ]) ;
    }

    /* === Show the form to edit a product === */
    public function editProducts(Request $request){
        return 'Edit products'." ".$request->id;
    }
    /* === Update a product === */
    public function updateProducts(Request $request){
       return response()->json([
           "status"=>Product::where('id',$request->id)->update($request->input()),
           "message"=>"Product updated successfully",
        ]) ;
    }

    /* === Delete a product === */
    public function deleteProducts(Request $request){
         return response()->json([
           "status"=>Product::where('id',$request->id)->delete(),
           "message"=>"Product deleted successfully",
        ]) ;
    }
}
