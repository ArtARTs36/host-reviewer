<?php

namespace App\Providers;

use App\Models\Host;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('DB_CONNECTION') === 'mysql') {
            Schema::defaultStringLength(191);
        }
    }
}
