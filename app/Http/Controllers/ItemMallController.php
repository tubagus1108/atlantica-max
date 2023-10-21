<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ItemMallController extends Controller
{
    public function index()
    {
        $data = DB::connection('atlantica')
            ->table('dbo.NGM_PRODUCT')
            ->select('product_seq', 'main_category', 'name', 'price', 'image')
            ->get();

        return view('users.item-mall', compact('data'));
    }

    public function GetCategoryProduct($id)
    {
        $data = DB::connection('atlantica')
            ->table('dbo.NGM_PRODUCT')
            ->where('main_category', $id)
            ->select('product_seq', 'main_category', 'name', 'price', 'image')
            ->get();

        // dd($data);
        return view('users.item-mall', compact('data'));
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
            $productPrice = $request->input('product_price', 0);
            $username = $user->user_id;

            // Get user cash from the database
            $userCash = DB::connection('member')
                ->table('dbo.GM_MEMBER')
                ->where('user_id', $username)
                ->value('cash');

            // Get the product price from the database
            $productPriceFromDB = DB::connection('atlantica')
                ->table('dbo.ngm_product')
                ->where('product_seq', $productID)
                ->value('price');

            if (!$productPriceFromDB) {
                Session::flash('error', 'Error in making the purchase. Data manipulation detected, avoid permanent suspension of your account.');
                return redirect()->route('item-mall');
            }

            if ($productPriceFromDB === $productPrice) {
                if ($userCash >= $productPrice) {
                    // Use a transaction to ensure data consistency
                    DB::connection('atlantica')->transaction(function ($request) use ($productID, $username, $productPrice, $userCash) {
                        // Insert the purchase record
                        DB::connection('atlantica')->insert("EXEC NGM_BUY_INS @product_seq=?, @user_id=?, @get_id=?, @order_count=?, @order_price=?, @money_real=?, @money_bonus=?, @money_event=?, @tx_no=?, @comment=?, @reg_ip=?", [
                            $productID,
                            $username,
                            $username,
                            1,
                            $productPrice,
                            0,
                            0,
                            0,
                            'sale',
                            'comment',
                            '127.0.0.1',
                        ]);

                        $newUserCash = $userCash - $productPrice;
                        DB::connection('member')
                            ->table('dbo.GM_MEMBER')
                            ->where('user_id', $username)
                            ->update(['cash' => $newUserCash]);

                        $usernewUpdate = DB::connection('member')
                            ->table('dbo.GM_MEMBER')
                            ->where('user_id', $username)
                            ->first(); // Use 'first' to retrieve a single record

                        if ($usernewUpdate) {
                            session()->forget('user');
                            // Update the 'cash' attribute in the user's session
                            session()->put('user', $usernewUpdate);

                            Session::flash('success', 'Purchase successful. Don\'t forget to collect the item in the game.');
                        } else {
                            // Handle the case where the user record is not found
                            Session::flash('error', 'User not found. Please handle this case accordingly.');
                        }
                    });

                    return redirect()->route('item-mall');
                } else {
                    Session::flash('error', 'You do not have enough balance to purchase this product.');
                }
            } else {
                Session::flash('error', 'Error in making the purchase. Data manipulation detected, avoid permanent suspension of your account.');
            }
        }

        return redirect()->route('item-mall');
    }
}
