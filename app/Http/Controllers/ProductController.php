<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /* === List All Products === */
    public function getAllProducts(){
        return view('index');
        $products= Product::get();
        return response()->json([
            "status"=>true,
            "message"=>"Product found successfully",
            "products"=>$products
        ]) ;
    }

    /* === Show the form to create a new product === */
    public function createProducts(){
        return view('create');
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
