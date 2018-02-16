<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductsView extends Model
{
    protected $table = "products_views";
    protected $guarded = [];
	
	public function product () {

		$this->belongsTo(Product::class);
	}
}
