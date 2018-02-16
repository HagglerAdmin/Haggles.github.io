<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRegister;
use App\Events\Registration;
use Mail;
use Hash;

use App\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('authentication.register');
    }

    public function store(ValidateRegister $request)
    {       
        $user = User::create([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'password' => Hash::make ( $request->input( 'password' ) ),
            'remember_token' => $request->input( '_token' )
        ]);

        event(new Registration($user, $request));
    }
}
