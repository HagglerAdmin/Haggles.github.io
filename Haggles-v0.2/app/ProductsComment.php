<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsComment extends Model
{
    protected $table = "products_comments";
    protected $guarded = [];

    public function product() {

        return $this->belongsTo(Product::class);
    }

    public function user() {

        return $this->belongsTo(User::class);
    }
}
