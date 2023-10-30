<?php

namespace App\Providers;

use App\Models\File;
use App\Models\Product;
use App\Models\ProductImage;
use App\Observers\FileObserver;
use App\Observers\ProductImageObserver;
use App\Observers\ProductObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // register ProductObserver for Product model
        Product::observe(new ProductObserver);
        // register ProductImageObserver for ProductImage model
        ProductImage::observe(new ProductImageObserver);
        //register FileObserver for File model
        File::observe(new FileObserver);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
