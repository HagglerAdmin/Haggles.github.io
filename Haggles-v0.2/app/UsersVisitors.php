<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersVisitors extends Model
{
    protected $table = "users_visitors";
    protected $guarded = [];

    public function user() {

        return $this->belongsTo(User::class);
    }
}
