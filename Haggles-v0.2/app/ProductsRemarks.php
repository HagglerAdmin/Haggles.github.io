<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsRemarks extends Model
{
	protected $table = "products_remarks";
	protected $guarded = [];   	

	public function product() {

		return $this->belongsTo(Product::class);

	}
}
