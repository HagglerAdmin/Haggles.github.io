<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsPhoto extends Model
{
    protected $table = "products_photos";
    protected $guarded = [];

    public function product() {

    	return $this->belongsTo(Product::class);
    	
    }
}
