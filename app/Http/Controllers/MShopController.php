<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MShopController extends Controller
{
    public function index()
    {
        $data = DB::connection('atlantica')
            ->table('dbo.A_BOND')
            ->select('itemid', 'name', 'price', 'image','img1','img2')
            ->get();

        return view('users.mshop', compact('data'));
    }

    public function GetCategoryProduct($id)
    {
        $data = DB::connection('atlantica')
            ->table('dbo.A_BOND')
            ->where('id', $id)
            ->select('itemid', 'name', 'price', 'image','img1','img2')
            ->get();

        // dd($data);
        return view('users.mshop', compact('data'));
    }

    public function purchase(Request $request)
    {
        if ($request->isMethod('post')) {
            $user = $request->session()->get('user');

            if (!$user) {
                Session::flash('error', 'You must log in to make a purchase.');
                return redirect()->route('item-mall');
            }

            $productID = $request->input('product_id', 0);
            $productPrice = $request->input('product_price', 0); // not used directly
            $quantity = $request->input('quantity', 1);
            $userId = $user->ID;

            // Validasi jumlah
            $validQuantities = [1, 10, 100, 1000];
            if (!in_array($quantity, $validQuantities)) {
                Session::flash('error', 'Invalid quantity!');
                return redirect()->route('item-mall');
            }

            // Ambil detail item
            $product = DB::connection('atlantica')
                ->table('dbo.A_CASH')
                ->where('itemid', $productID)
                ->first();

            if (!$product) {
                Session::flash('error', 'Item not found.');
                return redirect()->route('item-mall');
            }

            $itemPrice = $product->price;
            $itemName = $product->name;
            $itemCount = $product->itemcount;
            $totalPrice = $itemPrice * $quantity;

            // Ambil cash user
            $account = DB::connection('account')
                ->table('dbo.tbl_Account')
                ->where('ID', $userId)
                ->first();

            if (!$account) {
                Session::flash('error', 'User not found.');
                return redirect()->route('item-mall');
            }

            $userCash = $account->cash;

            if ($userCash < $totalPrice || $quantity > $itemCount) {
                Session::flash('error', 'Cash balance is insufficient or item stock is not enough.');
                return redirect()->route('item-mall');
            }

            DB::beginTransaction();

            try {

                // Update cash user
                DB::connection('account')
                    ->table('dbo.tbl_Account')
                    ->where('ID', $userId)
                    ->update(['cash' => $userCash - $totalPrice]);

                // Simpan pembelian
                DB::connection('atlantica')
                    ->table('dbo.NGM_BUY_ITEM')
                    ->insert([
                        'user_id' => $userId,
                        'item_num' => $quantity,
                        'item_name' => $itemName,
                        'item_unique' => $productID,
                    ]);

                // Update stok item
                DB::connection('atlantica')
                    ->table('dbo.A_CASH')
                    ->where('itemid', $productID)
                    ->update(['itemcount' => $itemCount - $quantity]);

                DB::commit();

                Session::flash('success', 'Purchase successful!');
            } catch (\Exception $e) {
                DB::rollBack();
                Session::flash('error', 'Transaction failed: ' . $e->getMessage());
            }

            return redirect()->route('item-mall');
        }

        return redirect()->route('item-mall');
    }
}
