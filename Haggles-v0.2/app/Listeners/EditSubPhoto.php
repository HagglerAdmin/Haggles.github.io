<?php

namespace App\Listeners;

use App\Product;
use App\Events\EditProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EditSubPhoto
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
     * @param  EditProduct  $event
     * @return void
     */
    public function handle(EditProduct $event)
    {
        if($event->request->photos == 0) {

        }
        else {

            Product::find($event->request->input('product_id'))->productphoto()

                ->where('photo_type', '=', 'sub')->delete();

            foreach ($event->request->photos as $photo) {

                $filename = $photo->store('photos');

                Product::find($event->request->input('product_id'))

                ->productphoto()->create([

                    'product_photo' => $filename,
                    'photo_type' => 'sub',

                ]);
            }
        }


    }
}
