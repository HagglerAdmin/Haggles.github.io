<?php

namespace App\Listeners;

use App\ProductsPhoto;
use App\Events\NewProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Image;
class ProductPhoto
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewProduct  $event
     * @return void
     */
    public function handle(NewProduct $event)
    {   
        
        $dp = $event->request['displayphotos']->store('photos');
        
        $photo = new ProductsPhoto();

        $photo->product_photo = $dp;
        $photo->photo_type = "Display";

        $event->product->productphoto()->save($photo);

        if ( $event->request->photos == 0)
        {
            
        }
        else 
        {
            foreach ($event->request->photos as $photo) {
                
                $filename = $photo->store('photos');
    
                $event->product->productphoto()->create([
    
                    'product_photo' => $filename,
                    'photo_type' => 'sub',
    
                ]);
            }
        }
        
    }
}
