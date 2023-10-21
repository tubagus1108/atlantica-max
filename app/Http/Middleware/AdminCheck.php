<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->session()->get('user');
        $check_role = DB::connection('game')->table('dbo.tbl_Account')
            ->where('id', $user->user_id)
            ->where('MasterLevel', 130)
            ->first();
        if ($check_role) {
            return $next($request);
        } else {
            return redirect()->route('home.index');
        }
    }
}
