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
                $username = $user->ID;
                $usernewUpdate = DB::connection('member')
                    ->table('dbo.GM_MEMBER')
                    ->where('user_id', $username)
                    ->first(); // Use 'first' to retrieve a single record

                $account = DB::connection('account')->table('dbo.tbl_Account')
                    ->where('ID', $user->{'ID'})
                    ->first();
                if ($usernewUpdate && $account) {
                    session()->forget('user');
                    session()->put('MasterLevelValue', $account->MasterLevelValue);
                    // Update the 'cash' attribute in the user's session
                    session()->put('user', $usernewUpdate);
                }
            }

            $view->with('user', $user);
        });
    }
}
