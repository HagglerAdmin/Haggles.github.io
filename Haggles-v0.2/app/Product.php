<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $guarded = [];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function bargain() {

        return $this->hasOne(Bargain::class);
    }

    public function productstock() {

        return $this->hasOne(ProductStock::class);
    }

    public function productdimension() {

        return $this->hasOne(ProductsDimension::class);
    }

    public function productphoto() {

    	return $this->hasMany(ProductsPhoto::class);
    }

    public function remarks () {

        return $this->hasOne(ProductsRemarks::class);
    }

   	public function view() {

    	return $this->hasMany(ProductsView::class);
    }

    public function comment() {

        return $this->hasMany(ProductsComment::class);
    }

    public function stockhistory () {

        return $this->hasMany(StockHistory::class);
    }
}
