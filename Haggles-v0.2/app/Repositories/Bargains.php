<?php

namespace App\Repositories;

use App\BargainsConversation;

class Bargains 
{
    public function countBuyer ($id)
    {
        return BargainsConversation::where('bargain_id', $id)->count();
    }
}