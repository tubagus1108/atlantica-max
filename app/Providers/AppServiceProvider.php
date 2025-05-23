<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot()
    {
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Hanya inject user jika session user sudah valid (dari middleware)
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $user = Session::get('user');
            $view->with('user', is_array($user) ? (object) $user : $user);
        });
    }

}
