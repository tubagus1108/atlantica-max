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
        $request->validate([
            'user_id' => 'required',
            'cash' => 'required',
        ]);

        $user = DB::connection('account')
            ->table('dbo.tbl_Account')
            ->where('ID', $request->input('user_id'))
            ->first();

        if ($user) {
            // Update the 'cash' field with the new amount
            $newCash = $user->cash + $request->input('cash');

            DB::connection('account')
                ->table('dbo.tbl_Account')
                ->where('ID', $request->input('user_id'))
                ->update(['cash' => $newCash]);

            DB::connection('account')
                ->table('dbo.redeem_log')
                ->insert([
                    'user_id' => $request->input('user_id'),
                    'cash_amount' => $newCash,
                    'redeem_code' => 'CODEADMIN' . Str::upper(Str::random(6)), // contoh: CODEADMINABC123
                ]);

            Session::flash('success', 'Send cash to user successful.');
        } else {
            Session::flash('error', 'User not found. Send cash failed.');
        }

        return redirect()->route('cash.index');
    }

    public function store1(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'cash' => 'required|numeric',
        ]);

        $userId = $validated['user_id'];
        $cashToAdd = $validated['cash'];

        $accountConnection = DB::connection('account');

        $user = $accountConnection
            ->table('dbo.tbl_Account')
            ->where('ID', $userId)
            ->first();

        if (!$user) {
            Session::flash('error', 'User not found. Send cash failed.');
            return redirect()->route('cash.index');
        }

        $newCash = $user->cash + $cashToAdd;

        try {
            $accountConnection->beginTransaction();

            $accountConnection->table('dbo.tbl_Account')
                ->where('ID', $userId)
                ->update(['cash' => $newCash]);

            $accountConnection->table('dbo.redeem_log')->insert([
                'user_id' => $userId,
                'cash' => $newCash,
                'redeem_code' => 'CODEADMIN',
                'created_at' => now(), // hanya jika kolom tersedia
            ]);

            $accountConnection->commit();

            Session::flash('success', 'Send cash to user successful.');
        } catch (\Exception $e) {
            $accountConnection->rollBack();
            Session::flash('error', 'An error occurred: ' . $e->getMessage());
        }

        return redirect()->route('cash.index');
    }

}
