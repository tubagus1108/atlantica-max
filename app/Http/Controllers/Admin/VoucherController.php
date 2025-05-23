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
        // Validasi input
        $validated = $request->validate([
            'code' => 'required|string|max:50',  // Atur panjang maksimal untuk keamanan
            'cash_amount' => 'required|numeric|min:0', // Pastikan jumlah uang yang valid
        ]);

        // Ambil data user dari session
        $sessionUser = Session::get('user');

        if (!$sessionUser || !isset($sessionUser['MasterLevelValue']) || $sessionUser['MasterLevelValue'] != 120) {
            abort(403, 'Unauthorized access.');
        }

        $code = $validated['code'];
        $cashAmount = $validated['cash_amount'];

        // Cek apakah kode sudah digunakan
        $accountDb = DB::connection('account');
        $alreadyRedeemed = $accountDb->table('redeem_codes')
            ->where('code', $code)
            ->exists();

        if ($alreadyRedeemed) {
            return back()->withErrors(['errors' => 'Kode redeem sudah digunakan. Silakan gunakan kode lain.']);
        }

        try {
            // Memulai transaksi
            $accountDb->beginTransaction();

            // Insert data redeem code ke dalam database
            $accountDb->table('redeem_codes')->insert([
                'code' => $code,
                'cash' => $cashAmount,
            ]);

            // Commit transaksi
            $accountDb->commit();

            return back()->with(['success' => 'Cash berhasil ditambahkan!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            $accountDb->rollBack();
            return back()->withErrors(['errors' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
