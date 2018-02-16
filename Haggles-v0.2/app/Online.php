<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Online extends Model
{
    protected $table = "onlines";
    protected $guarded = [];

    public function  user() {

        return $this->belongsTo(User::class);
    }
}
