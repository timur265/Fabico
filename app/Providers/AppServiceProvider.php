<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        $this->app->bind('path.public', function() {
            return base_path('public_html');
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $count = 0;
        if(isset($_COOKIE['products']))
        {
            foreach(json_decode($_COOKIE['products']) as $item)
            {
                $count += ((isset($item->count)) ? $item->count : 1);
            }
        }
        View::share('count', $count);
        View::share('key', 'value');
    }
}
