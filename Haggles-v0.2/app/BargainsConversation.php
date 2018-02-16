<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BargainsConversation extends Model
{
    protected $table = "bargains_conversations";
    protected $guarded = [];

    public function bargain() {

    	return $this->belongsTo(Bargain::class);
    }

    public function user() {
        
        return $this->belongsTo(User::class);
    }

}
