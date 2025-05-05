<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserInventoryController extends Controller
{
    private $itemPrices = [
        8398 => 300000,
        8399 => 3000000,
        8374 => 30000000,
        8349 => 100000000
    ];

    private $itemNames = [
        8398 => "Atlantis Silver Coin",
        8399 => "Atlantis Gold Coin",
        8374 => "Atlantis Platinum Coin",
        8349 => "Glittery Gold Chocolate (Event)"
    ];

    public function index(Request $request)
    {
        $user = Session::get('user');
        if (!$user) {
            return redirect('/auth/login');
        }

        $account = DB::connection('account')
            ->table('tbl_Account')
            ->select('IDNum')
            ->where('ID', $user->{'ID'})
            ->first();

        if (!$account) {
            abort(404, 'Akun tidak ditemukan');
        }

        $characters = DB::connection('game')
            ->table('tbl_Person as p')
            ->join('tbl_Account as a', 'p.IDNum', '=', 'a.IDNum')
            ->where('a.IDNum', $account->IDNum)
            ->select('p.PersonID', 'p.Name')
            ->get();

        $inventory = [];
        if ($request->has('select_character')) {
            $characterId = $request->input('character_id');

            $inventory = DB::connection('game')
                ->table('tbl_ExtraInvenItem')
                ->where('SlotIdx', 0)
                ->where('ItemPos', 0)
                ->whereIn('ItemUnique', array_keys($this->itemPrices))
                ->where('PersonID', $characterId)
                ->get();
        }

        return view('others.sell-coin', [
            'characters' => $characters,
            'inventory' => $inventory,
            'itemNames' => $this->itemNames,
            'itemPrices' => $this->itemPrices
        ]);
    }

    public function sell(Request $request)
    {
        $request->validate([
            'character_id' => 'required|integer',
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:9000',
        ]);

        $characterId = $request->input('character_id');
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity');

        if (!isset($this->itemPrices[$itemId])) {
            return back()->with('error', 'Item tidak valid.');
        }

        $item = DB::connection('game')
            ->table('tbl_ExtraInvenItem')
            ->where('PersonID', $characterId)
            ->where('ItemUnique', $itemId)
            ->first();

        if (!$item || $item->ItemNum < 2) {
            return back()->with('error', 'Anda harus memiliki minimal 2 item untuk dapat menjualnya.');
        }

        if ($quantity > $item->ItemNum) {
            return back()->with('error', 'Jumlah item yang ingin Anda jual melebihi jumlah yang Anda miliki.');
        }

        $totalMoney = $this->itemPrices[$itemId] * $quantity;

        DB::connection('game')->beginTransaction();

        try {
            DB::connection('game')
                ->table('tbl_Person')
                ->where('PersonID', $characterId)
                ->update([
                    'Money' => DB::raw("Money + $totalMoney")
                ]);

            DB::connection('game')
                ->table('tbl_ExtraInvenItem')
                ->where('PersonID', $characterId)
                ->where('ItemUnique', $itemId)
                ->where('SlotIdx', 0)
                ->where('ItemPos', 0)
                ->where('ItemNum', '>=', $quantity)
                ->update([
                    'ItemNum' => DB::raw("ItemNum - $quantity")
                ]);

            DB::connection('game')
                ->table('tbl_ExtraInvenItem')
                ->where([
                    ['PersonID', '=', $characterId],
                    ['ItemUnique', '=', $itemId],
                    ['SlotIdx', '=', 0],
                    ['ItemPos', '=', 0],
                    ['ItemNum', '=', 0],
                ])
                ->update([
                    'SlotIdx' => 0,
                    'ItemPos' => 0,
                    'ItemUnique' => 0,
                    'ItemNum' => 0,
                    'SerialNum' => 0,
                ]);

            DB::connection('game')->commit();

            return back()->with('success', "Anda berhasil menjual $quantity item dan mendapatkan $totalMoney Money!");
        } catch (\Exception $e) {
            DB::connection('game')->rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menjual item.');
        }
    }
}
