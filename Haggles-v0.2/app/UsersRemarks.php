<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersRemarks extends Model
{
    protected $table = "users_remarks";
    protected $fillable = ['user_id','account_type','user_status','premium_exp','verification_code','account_status'];

    public function user() {

    	return $this->belongsTo(User::class);
    }
}
