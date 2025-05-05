<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Session::get('user');

        if (!$user) {
            return redirect(route('home.index'));
        }
        $check_role = DB::connection('account')->table('dbo.tbl_Account')
            ->where('ID', $user->{'ID'})
            ->where('MasterLevelValue', '>', 104)
            ->where('MasterLevelExpireTime', '>=', Carbon::now())
            ->where('MasterLevel', '>', 104)
            ->first();

        if ($check_role) {
            return $next($request);
        } else {
            return redirect()->route('home.index');
        }
    }
}
