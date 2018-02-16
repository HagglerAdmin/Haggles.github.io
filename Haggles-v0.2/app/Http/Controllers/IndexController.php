<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class IndexController extends Controller
{
    public function index ()
    {      
        $category = Category::all();

        return view('index.index', compact('category'));
    }
}