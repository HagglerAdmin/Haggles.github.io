<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = "billings";
    protected $guarded = [];

    public function user() {

        return $this->belongsTo(User::class);
    }
}
