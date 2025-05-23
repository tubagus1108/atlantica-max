<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CashController extends Controller
{
    public function index()
    {
        return view('admin.cash.cash');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|numeric',
            'cash' => 'required|numeric|min:1',
        ]);

        // Ambil user yang sedang login dari session
        $sessionUser = Session::get('user');

        // Cek apakah user login dan memiliki akses admin (MasterLevelValue 120)
        if (!$sessionUser || !isset($sessionUser['MasterLevelValue']) || $sessionUser['MasterLevelValue'] != 120) {
            abort(403, 'Unauthorized access.');
        }

        // Ambil user target berdasarkan input user_id
        $targetUser = DB::connection('account')
            ->table('dbo.tbl_Account')
            ->where('ID', $request->input('user_id'))
            ->first();

        if ($targetUser) {
            $newCash = $targetUser->cash + $request->input('cash');

            // Lakukan update cash
            DB::connection('account')
                ->table('dbo.tbl_Account')
                ->where('ID', $request->input('user_id'))
                ->update(['cash' => $newCash]);

            // Simpan log penambahan cash
            DB::connection('account')
                ->table('dbo.redeem_log')
                ->insert([
                    'user_id' => $request->input('user_id'),
                    'cash_amount' => $request->input('cash'),
                    'redeem_code' => 'CODEADMIN' . Str::upper(Str::random(6)),
                    'created_at' => now(), // Jika tabel memiliki timestamp
                ]);

            Session::flash('success', 'Send cash to user successful.');
        } else {
            Session::flash('error', 'User not found. Send cash failed.');
        }

        return redirect()->route('cash.index');
    }
}
