<?php 

namespace App\Repositories;

use App\User;
use Auth;

class UserPicture
{

    public function display() {

        if (Auth::check()) {

            return User::find(Auth::id())->picture->where('photo_type', 'display');
        }
    }
}