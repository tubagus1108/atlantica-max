<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session; // Import the Session facade

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
        View::composer('*', function ($view) {
            $user = null;

            // Access the user from the session
            if (Session::has('user')) {
                $user = Session::get('user');
                $username = $user->user_id;
                $usernewUpdate = DB::connection('member')
                    ->table('dbo.GM_MEMBER')
                    ->where('user_id', $username)
                    ->first(); // Use 'first' to retrieve a single record

                if ($usernewUpdate) {
                    session()->forget('user');
                    // Update the 'cash' attribute in the user's session
                    session()->put('user', $usernewUpdate);
                    Log::info("SUCESS UPDATE SESSION");
                }
            }

            $view->with('user', $user);
        });
    }
}
