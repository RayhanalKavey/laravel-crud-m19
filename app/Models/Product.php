<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = ['name', 'description', 'price', 'stock', 'image'];

   
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->product_id = str_replace(' ', '', strtolower($product->name)) . rand(1000, 9999);
        });
    }
  

   /* 
    protected static function booted()
    {
        static::creating(function ($product) {
            // Create product_id by combining product name and a random number
            $product->product_id = strtoupper(str_limit($product->name, 3)) . '-' . rand(1000, 9999);
        });
    }
   */
    
}
