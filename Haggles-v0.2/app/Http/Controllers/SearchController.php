<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show($tag) 
    {   
        $product = (new \App\Repositories\Products)->search('search-tag',$tag,"null");

        return view('search.search',compact('product'));
    }

    public function filterPrice(Request $request)
    {
        if ( $request->input('filterBy') == "Lowest" ) 
        {
            $product = (new \App\Repositories\Products)->search('lowestTag', $request->input('key') ,'null');
        }
        else if ( $request->input('filterBy') == "Highest" ) 
        {
            $product = (new \App\Repositories\Products)->search('highestTag', $request->input('key') ,'null');
        }
    
        return view('search.search-product')->with('product', $product)->render();
    }

    public function filterDate(Request $request)
    {
        if ( $request->input('filterBy') == "Lastest" )
        {
            $product = (new \App\Repositories\Products)->search('lastestTag', $request->input('key') ,'null');
        }
        else if ( $request->input('filterBy') == "Oldest" )
        {
            $product = (new \App\Repositories\Products)->search('lowestTag', $request->input('key') ,'null');
        }

        return view('search.search-product')->with('product', $product)->render();
    }

    public function filterCategory(Request $request)
    {
        $product = (new \App\Repositories\Categories)->search('search-category',$request->input('key'),$request->input('filterBy'));

        return view('search.search-product')->with('product', $product)->render();
    }
}
