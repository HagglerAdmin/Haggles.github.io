<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = "activities";
    protected $guarded = [];

    public function user() {

        return $this->belongsTo(User::class);
    }
}
