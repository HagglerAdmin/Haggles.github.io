<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersRates extends Model
{
    protected $table = "users_rates";
    protected $fillable = ['users_id','users_feedback','star_rating','feedback_condition'];
}
