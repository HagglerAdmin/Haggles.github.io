<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersProfile extends Model
{
    protected $table = "users_profiles";
    protected $guarded = [];

    public function user() {
        
    	$this->belongsTo(User::class);
    }
}
