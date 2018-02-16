<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HaggleUserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($haggler,User $user)
    {    

        $product = (new \App\Repositories\Products)->users($user->id);

        return view('haggler.profile', compact('user','product'));
    }

   public function filterCategory (Request $request) 
   {
        if ( $request->input('category') != "all")  {
            $product = (new \App\Repositories\Categories)->search('haggler-category', $request->input('category'), $request->input('id'));
        }
        else {
            $product = (new \App\Repositories\Products)->show();
        }

        return view('haggler.product')->with('product', $product)->render();
   }

   public function filterDate (Request $request) 
   {
        $date = $request->input('date');

        if ($date == "Oldest") 
        {
            $product = (new \App\Repositories\Products)->search('oldest','null',$request->input('id'));
        }
        else
        {
            $product = (new \App\Repositories\Products)->search('lastest','null',$request->input('id'));
        }

        return view('haggler.product')->with('product', $product)->render();
   }

   public function filterPrice (Request $request)
   {
         $price = $request->input('price');

         if ($price == "Lowest") 
         {
             $product = (new \App\Repositories\Products)->search('lowest','null',$request->input('id'));
         }
         else
         {
             $product = (new \App\Repositories\Products)->search('highest','null',$request->input('id'));
         }
 
         return view('haggler.product')->with('product', $product)->render();
   }
}