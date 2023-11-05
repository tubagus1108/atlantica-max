<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

        $user = DB::connection('member')
            ->table('dbo.GM_MEMBER')
            ->where('user_id', $request->input('user_id'))
            ->first();

        if ($user) {
            // Update the 'cash' field with the new amount
            $newCash = $user->cash + $request->input('cash');

            DB::connection('member')
                ->table('dbo.GM_MEMBER')
                ->where('user_id', $request->input('user_id'))
                ->update(['cash' => $newCash]);

            Session::flash('success', 'Send cash to user successful.');
        } else {
            Session::flash('error', 'User not found. Send cash failed.');
        }

        return redirect()->route('cash.index');
    }
}
