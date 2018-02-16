<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsDimension extends Model
{
	protected $table = "products_dimensions";
   	protected $guarded = [];

   	public function product() {

   	    return $this->belongsTo(Product::class);
    }
}
