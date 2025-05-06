<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VoucherController extends Controller
{
    public function index()
    {
        return view('admin.voucher');
    }


    public function store(Request $request)
{
    $validated = $request->validate([
        'code' => 'required|string',
        'cash_amount' => 'required',
    ]);

    $user = Session::get('user');
    if (!$user || !isset($user->ID)) {
        return back()->withErrors(['errors' => 'User tidak ditemukan atau belum login.']);
    }

    $code = $validated['code'];
    $cashAmount = $validated['cash_amount'];

    $accountDb = DB::connection('account');

    // Cek apakah kode sudah digunakan
    $alreadyRedeemed = $accountDb->table('redeem_codes')
        ->where('code', $code)
        ->exists();

    if ($alreadyRedeemed) {
        return back()->withErrors(['errors' => 'Kode redeem sudah digunakan. Silakan gunakan kode lain.']);
    }

    try {
        $accountDb->beginTransaction();

        $accountDb->table('redeem_codes')->insert([
            'code' => $code,
            'cash' => $cashAmount
        ]);

        $accountDb->commit();

        return back()->with(['success' => 'Cash berhasil ditambahkan!']);
    } catch (\Exception $e) {
        // $accountDb->rollBack();
        return back()->withErrors(['errors' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}

}
