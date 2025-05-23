<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExchangeController extends Controller
{
    /**
     * Display the exchange page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check if user is authenticated
        if (!Session::get('user')) {
            return redirect('/login');
        }

        $user_id = Session::get('user')['id'];

        // Get IDNum from account database
        $account = DB::connection('account')
            ->table('tbl_Account')
            ->where('ID', $user_id)
            ->select('IDNum', 'Bond')
            ->first();

        if (!$account) {
            abort(404, 'Account not found.');
        }

        $id_num = $account->IDNum;
        $bond = $account->Bond;

        // Get characters from game database
        $characters = DB::connection('game')
            ->table('tbl_Person')
            ->where('IDNum', $id_num)
            ->select('PersonID', 'Name', 'Money')
            ->get();

        // Get exchange rate from game database
        $exchange_rate = DB::connection('game')
            ->table('Exchange_gold')
            ->where('ExchangeType', 'MoneyToBond')
            ->select('ExchangeRate', 'RateGold')
            ->first();

        if (!$exchange_rate) {
            abort(404, 'Exchange rate not found.');
        }

        $rate = $exchange_rate->ExchangeRate;
        $rate_gold = $exchange_rate->RateGold;
        $total_money_per_bond = $rate * (1 - $rate_gold);

        return view('exchange.index', compact('characters', 'bond', 'rate', 'rate_gold', 'total_money_per_bond'));
    }

    /**
     * Process the exchange.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exchange(Request $request)
    {
        // Validate the request
        $request->validate([
            'person_id' => 'required|integer',
            'bond_to_exchange' => 'required|integer|min:1',
        ]);

        $user_id = Session::get('user')['id'];
        $person_id = $request->input('person_id');
        $bond_to_exchange = (int) $request->input('bond_to_exchange');
        // dd($request);
        // Get IDNum from account database
        $account = DB::connection('account')
            ->table('tbl_Account')
            ->where('ID', $user_id)
            ->select('IDNum')
            ->first();

        if (!$account) {
            return back()->with('error', 'Account not found.');
        }

        $id_num = $account->IDNum;

        // Get exchange rate from game database
        $exchange_rate = DB::connection('game')
            ->table('Exchange_gold')
            ->where('ExchangeType', 'MoneyToBond')
            ->select('ExchangeRate', 'RateGold')
            ->first();

        if (!$exchange_rate) {
            return back()->with('error', 'Exchange rate not found.');
        }

        $rate = $exchange_rate->ExchangeRate;
        $rate_gold = $exchange_rate->RateGold;
        $total_money_per_bond = $rate * (1 - $rate_gold);
        $money_to_exchange = $bond_to_exchange * $total_money_per_bond;

        // Check if character has enough money
        $character = DB::connection('game')
            ->table('tbl_Person')
            ->where('PersonID', $person_id)
            ->where('IDNum', $id_num)
            ->first();

        // dd($character);
        // dd($character->Money);
        // dd(number_format($money_to_exchange));

        if (!$character || $character->Money < $money_to_exchange) {
            return back()->with('error', "Money karakter tidak mencukupi untuk menukarkan {$bond_to_exchange} M-Cash.");
        }

        // Start transaction
        DB::beginTransaction();

        try {
            // Decrease Money from character
            DB::connection('game')
                ->table('tbl_Person')
                ->where('PersonID', $person_id)
                ->where('IDNum', $id_num)
                ->decrement('Money', $money_to_exchange);

            // Increase Bond in account
            DB::connection('account')
                ->table('tbl_Account')
                ->where('IDNum', $id_num)
                ->increment('Bond', $bond_to_exchange);

            DB::commit();

            return redirect()->route('exchange.index')
                ->with('success', "Berhasil menukarkan " . number_format($money_to_exchange) . " Gold menjadi " . $bond_to_exchange . " M-Cash!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
