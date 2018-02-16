<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPhoto extends Model
{
    protected $table = "users_photos";
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
