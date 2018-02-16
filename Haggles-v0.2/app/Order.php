<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $guarded = [];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function notification() {

        return $this->hasOne(Notification::class);
    }

}
