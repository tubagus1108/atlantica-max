<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->session()->get('user');
        if (!$user) {
            return redirect(route('home.index'));
        }
        $check_role = DB::connection('member')->table('dbo.GM_MEMBER')
            ->where('user_id', $user->user_id)
            ->where('sec_primary', 3)
            ->where('sec_content', 3)
            ->first();
        if ($check_role) {
            return $next($request);
        } else {
            return response()->json(['code' => '403', 'message' => 'Forbidden']);
        }
    }
}
