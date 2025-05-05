<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OtherFeatureController extends Controller
{
    public function index(){
        return view('others.m-cash');
    }

    public function patchManual(){
        $data = DB::connection('patch')->table('tbl_Listpatch')->get();

        return view('others.patch-manual',compact('data'));
    }

    public function redeemIndex()
    {
        return view('others.redeem');
    }

    public function redeem(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $userId = Session::get('user')->{'ID'}; // pastikan user sudah login dan ID tersedia
        $code = $request->input('code');

        $accountDb = DB::connection('account');

        // Cek apakah kode sudah digunakan
        $alreadyRedeemed = $accountDb->table('redeem_log')
            ->where('redeem_code', $code)
            ->exists();

        if ($alreadyRedeemed) {
            return back()->withErrors(['errors' => 'Kode redeem sudah digunakan.']);
        }

        // Ambil cash dari redeem_codes
        $redeem = $accountDb->table('redeem_codes')->where('code', $code)->first();

        if (!$redeem) {
            return back()->withErrors(['errors' => 'Kode redeem tidak valid atau tidak ditemukan.']);
        }

        DB::connection('account')->beginTransaction();

        try {
            // Tambahkan cash ke user
            $accountDb->table('tbl_Account')
                ->where('ID', $userId)
                ->update([
                    'cash' => DB::raw("cash + {$redeem->cash}")
                ]);

            // Hapus kode dari redeem_codes
            $accountDb->table('redeem_codes')
                ->where('code', $code)
                ->delete();

            // Simpan ke redeem_log
            $accountDb->table('redeem_log')->insert([
                'user_id' => $userId,
                'redeem_code' => $code,
                'cash_amount' => $redeem->cash,
            ]);

            DB::connection('account')->commit();

            return back()->withErrors(['success' => 'Cash berhasil ditambahkan!']);
        } catch (\Exception $e) {
            DB::connection('account')->rollBack();
            return back()->withErrors(['errors' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
