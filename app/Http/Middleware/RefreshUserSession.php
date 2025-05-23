<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RefreshUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $sessionUser = Session::get('user');

        // Jika session user adalah stdClass (lama), hapus session
        if (is_object($sessionUser)) {
            Session::forget('user');
            return redirect()->route('login.index')->withErrors('Session lama tidak valid, silakan login kembali.');
        }

        // Jika session user dalam bentuk array dan ada id-nya
        if (is_array($sessionUser) && isset($sessionUser['id'])) {
            $userId = $sessionUser['id'];

            $account = DB::connection('account')
                ->table('dbo.tbl_Account')
                ->where('ID', $userId)
                ->select('ID', 'cash', 'bond', 'MasterLevelValue','LastCharName')
                ->first();

            if ($account) {
                $safeUserData = [
                    'id' => $account->ID,
                    'cash' => $account->cash ?? 0,
                    'bond' => $account->bond ?? 0,
                    'LastCharName' => $account->LastCharName,
                    'MasterLevelValue' => $account->MasterLevelValue ?? 0,
                ];

                Session::put('user', $safeUserData);
            }
        }

        return $next($request);
    }
}
