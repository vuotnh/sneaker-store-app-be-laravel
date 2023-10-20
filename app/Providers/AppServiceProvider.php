<?php

namespace App\Providers;

use DB;
use Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // create logging sql query
        DB::listen(function ($query) {
            Log::info(
                $query->sql, [
                    'bindings' => $query->bindings,
                    'time' => $query->time
                ]
                );
        });
    }
}
