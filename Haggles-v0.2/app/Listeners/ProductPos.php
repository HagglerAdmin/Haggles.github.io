<?php

namespace App\Listeners;

use Auth;
use App\Events\NewProduct;
use App\ProductPosition;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductPos
{

    public function __construct()
    {
        //
    }

    public function handle(NewProduct $event)
    {
        $pos = ProductPosition::where('user_id', Auth::id())->count();

        if ($pos > 0)
        {
            $position = ProductPosition::where('user_id', Auth::id())->get();
            

            foreach ( $position as $key )
            {
                $array = json_decode($key->position);

                array_push($array, $event->product->id);
                
                ProductPosition::where('user_id', Auth::id())->update([ 'position' => json_encode($array) ]);
            }

        }
    }
}