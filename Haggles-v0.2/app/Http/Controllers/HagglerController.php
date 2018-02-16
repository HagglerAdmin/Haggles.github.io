<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsersProfile;
use App\User;

class HagglerController extends Controller
{
    public function index() 
    {   
        $lists = (new \App\Repositories\Haggler)->featured();
        return view('haggler.list', compact('lists'));
    }

    public function show($id) 
    {

    }

    public function featured ()
    {
        $lists = (new \App\Repositories\Haggler)->featured();

        return view('haggler.list-datas')->with('lists', $lists)->render();    
    }

    public function search (Request $request)
    {
        $input = '%'.$request->keyword.'%';

        $lists = (new \App\Repositories\Haggler)->search($input);   

        return view('haggler.list-datas')->with('lists', $lists)->render();
    }
}
