<?php

namespace App\Listeners;

use App\Product;
use App\Events\EditProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EditCoverPhoto
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
        if($event->request['displayphotos'] == 0) {

        }
        else {

            $dp = $event->request['displayphotos']->store('photos');

            Product::find($event->request->input('product_id'))

            ->productphoto()

            ->where('photo_type', '=', 'display')

            ->update([
                'product_photo' => $dp,
            ]);
        }

    }
}
