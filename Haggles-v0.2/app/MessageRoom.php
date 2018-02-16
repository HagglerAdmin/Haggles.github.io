<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageRoom extends Model
{
    protected $table = "message_rooms";
    protected $guarded = [];

    public function messages ()
    {
        return $this->hasMany(Message::class);
    }
}
