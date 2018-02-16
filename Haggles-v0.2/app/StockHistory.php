<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{   
    protected $table = "stock_histories";
    protected $guarded = [];
    
    public function product ()
    {
        return $this->belongsTo(Product::class);
    }
}