<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use Session;

class LogoutController extends Controller
{
    public function userlogout() {

        Auth::logout();
		Session::flush();

        return redirect('/login');
        
    }
}
