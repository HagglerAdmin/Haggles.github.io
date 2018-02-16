<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
class LoginController extends Controller
{

    public function index()
    {

        return view('authentication.login');
    }

    public function loginUser(Request $request) {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        
        $count = User::where('username', $request->input('username'))->count();

        if($count > 0) {
            if(Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) 
            {
                User::find(auth::id())->userSession();
            }
            else
            {
                return "Check your Username or Password";
            }
        }
        else if( $count <= 0) {

            return "Account does'nt exist";         
        }
     }

     public function activate ($id)
     {
        User::find($id)->remark()->update(['account_status' => 'Active']);

        return redirect('login');
     }
}
