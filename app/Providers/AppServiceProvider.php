<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session; // Import the Session facade
use Illuminate\Support\Facades\URL;

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
    public function boot()
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer('*', function ($view) {
            $user = null;

            // Access the user from the session
            if (Session::has('user')) {
                $user = Session::get('user');
                $username = $user->{'ID'};

                $account = DB::connection('account')->table('dbo.tbl_Account')
                    ->where('ID', $username)
                    ->first();

                if ($account) {
                    session()->forget('user');
                    // Update the 'cash' attribute in the user's session
                    session()->put('user', $account);
                }
            }

            $view->with('user', $user);
        });
    }
}
