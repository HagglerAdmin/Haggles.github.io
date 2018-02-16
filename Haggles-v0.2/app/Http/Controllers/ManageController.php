<?php

namespace App\Http\Controllers;

use App\UsersProfile;
use Illuminate\Http\Request;
use App\User;
use App\UsersPhoto;
use Auth;
use Redirect;

class ManageController extends Controller
{
    public function index ()
    {
        return view('store.manage');
    }

    public function updateDp(Request $request) {
        
        $dp = $request['pic_filename']->store('photos');

        $count = User::find(Auth::id())->picture()->count();

        if ($count >= 1) {

            $select = User::find(Auth::id())->picture()->where(['user_id' => auth::id(), 'photo_type' => 'Display'])->get();

            foreach ($select as $key => $value) {

                UsersPhoto::find($value->id)->update(['photo_type' => 'sub']);
            }


            User::find(auth::id())->picture()->create(['user_photo' => $dp, 'photo_type' => 'display']);

        } else {

            UsersPhoto::create(['user_id' => auth::id(), 'user_photo' => $dp, 'photo_type' => 'display']);
        }

        return Redirect::back();
    }

}   