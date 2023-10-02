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
        $data = DB::connection('atlantica')->table('dbo.NGM_PRODUCT')->select('product_seq', 'main_category', 'name', 'price', 'image')->get();
        // dd($data);
        return view('users.item-mall', compact('data'));
    }

    public function purchase(Request $request)
    {
        if ($request->isMethod('post')) {
            if (!$request->session()->get('user')) {
                Session::flash('error', 'You must log in to make a purchase.');
                return redirect()->route('item-mall');
            }

            if ($request->session()->get('user')) {
                $productID = $request->input('product_id', 0);
                $productPrice = $request->input('product_price', 0);

                $username = $request->session()->get('user')->user_id;
                $currentTimestamp = time(); // This gives you a Unix timestamp

                try {
                    // Get user cash from the database
                    $userCash = DB::connection('member')->table('dbo.GM_MEMBER')->where('user_id', $username)->value('cash');

                    // Get the product price from the database
                    $productPriceFromDB = DB::connection('atlantica')->table('dbo.ngm_product')->where('product_seq', $productID)->value('price');

                    if (!$productPriceFromDB) {
                        Session::flash('error', 'Error in making the purchase. Data manipulation detected, avoid permanent suspension of your account.');
                        return redirect()->route('item-mall');
                    }

                    // dd($userCash);
                    if ($productPriceFromDB === $productPrice) {
                        if ($userCash >= $productPrice) {
                            // Start a database transaction

                            // DB::connection('atlantica')->beginTransaction();
                            try {

                                // Insert the purchase record
                                DB::connection('atlantica')->table('dbo.NGM_BUY')->insert([
                                    'product_seq' => $productID,
                                    'user_id' => $username, // Use the correct column name here
                                    'get_id' => $username,
                                    'order_count' => 1,
                                    'order_price' => $productPrice,
                                    'money_real' => 0,
                                    'money_bonus' => 0,
                                    'money_event' => 0,
                                    'tx_no' => 'sale',
                                    'comment' => 'comment',
                                    'reg_ip' => '127.0.0.1',
                                    'origin' => 'WEB',
                                ]);

                                // Update user cash
                                DB::connection('member')->table('dbo.GM_MEMBER')->where('user_id', $username)->update(['cash' => $userCash - $productPrice]);

                                // Commit the transaction
                                // DB::commit();

                                Session::flash('success', 'Purchase successful. Don\'t forget to collect the item in the game.');
                                return redirect()->route('item-mall');
                            } catch (\Exception $e) {
                                // Rollback the transaction on error
                                // DB::rollBack();
                                Session::flash('error', 'Error while making the purchase.' . $e->getMessage());
                                error_log('Error in purchase: ' . $e->getMessage(), 3, 'file.log');
                                return redirect()->route('item-mall');
                            }
                        } else {
                            Session::flash('error', 'You do not have enough balance to purchase this product.');
                            return redirect()->route('item-mall');
                        }
                    } else {
                        Session::flash('error', 'Error in making the purchase. Data manipulation detected, avoid permanent suspension of your account.');
                        return redirect()->route('item-mall');
                    }
                } catch (\PDOException $e) {
                    Session::flash('error', "Error while making the purchase: " . $e->getMessage());
                    return redirect()->route('item-mall');
                }
            }
        }
    }
}
