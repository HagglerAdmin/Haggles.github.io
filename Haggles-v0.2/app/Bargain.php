<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bargain extends Model
{
    protected $table = "bargains";
    protected $guarded = [];

    public function product() {

    	return $this->belongsTo(Product::class);
    }

    public function convo() {

    	return $this->hasMany(BargainsConversation::class);
    }
}
