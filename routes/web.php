<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
/* === List All Products === */
Route::get('/products',[ProductController::class,'getAllProducts']);

/* === Show the form to create a new product === */
Route::get('/products/create',[ProductController::class,'createProducts']);

/* === Store a new product === */
Route::post('/products',[ProductController::class,'storeProducts']);

/* === Show a specific product === */
Route::get('/products/{id}',[ProductController::class,'specificProducts']);

/* === Show the form to edit a product === */
Route::get('/products/{id}/edit',[ProductController::class,'editProducts']);

/* === Update a product === */
Route::put('/products/{id}',[ProductController::class,'updateProducts']);

/* === Delete a product === */
Route::delete('/products/{id}',[ProductController::class,'deleteProducts']);

/* 

DELETE /products/{id}: Delete a product
*/