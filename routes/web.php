<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search-products', [ProductController::class, 'searchProducts'])->name('products.search');

Route::get('/products',[ProductController::class,'getAllProducts'])->name('products.index');//List All Products

Route::get('/products/create',[ProductController::class,'createProducts'])->name('products.create');//Show the form to create a new product

Route::post('/products',[ProductController::class,'storeProducts'])->name('products.store');//Store a new product

Route::get('/products/{id}',[ProductController::class,'specificProducts'])->name('products.show');//Show a specific product

Route::get('/products/{id}/edit',[ProductController::class,'editProducts'])->name('products.edit');//Show the form to edit a product

Route::put('/products/{id}',[ProductController::class,'updateProducts'])->name('products.update');//Update a product

Route::delete('/products/{id}',[ProductController::class,'deleteProducts'])->name('products.delete');//Delete a product
