<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->session()->get('user');

        if (!$user) {
            return redirect(route('home.index'));
        }

        // Memeriksa jika level role 120
        $check_role = DB::connection('account')->table('dbo.tbl_Account')
            ->where('ID', $user['id'])
            ->where('MasterLevelValue', 120)
            ->where('MasterLevelExpireTime', '>=', Carbon::now())
            ->where('MasterLevel', 120)
            ->first();

        if ($check_role) {
            return $next($request);
        }

        return redirect(route('home.index'));
    }
}
