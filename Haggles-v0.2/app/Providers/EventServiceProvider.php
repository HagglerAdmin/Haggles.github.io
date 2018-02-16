<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{   

    // 'App\Listeners\DeductStock'
    // App\Listeners\BargainRoom
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Registration' => [
            'App\Listeners\registerProfile',
            'App\Listeners\registerRemarks',
            'App\Listeners\registerVerification'
        ],
        'App\Events\NewProduct' => [
            'App\Listeners\ProductDimension',
            'App\Listeners\ProductRemark',
            'App\Listeners\Stock',
            'App\Listeners\ProductPhoto',
            'App\Listeners\ProductPos'
        ],
        'App\Events\EditProduct' => [
            'App\Listeners\EditStock',
            'App\Listeners\EditDimension',
            'App\Listeners\EditCoverPhoto',
            'App\Listeners\EditSubPhoto',
            'App\Listeners\EditProductRemark'
        ],
        'App\Events\ViewProduct' => [
            'App\Listeners\View'
        ],
        'App\Events\BargainDeal' => [
            'App\Listeners\NotifySeller',
        ],
        'App\Events\Buying' => [
            'App\Listeners\buyNotification',
        ],
        'App\Events\Bought' => [
            'App\Listeners\NotifyBuyer',
            'App\Listeners\boughtStock'
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

    }
}
