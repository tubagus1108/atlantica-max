<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.product');
    }


    public function store(Request $request)
    {
        // Validasi form input
        $request->validate([
            'main_category' => 'required',
            'item_unique' => 'required',
            'item_num' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $imageVar = null;
        $eximageVar = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageVar = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/itemmall'), $imageVar);
        }

        if ($request->hasFile('eximage')) {
            $eximage = $request->file('eximage');
            $eximageVar = time() . '_ex.' . $eximage->getClientOriginalExtension();
            $eximage->move(public_path('assets/images/itemmall'), $eximageVar);
        }

        // Persiapkan data input
        $inputData = [
            'group_seq' => 1,
            'main_category' => $request->input('main_category'),
            'sub_category' => 1,
            'best_flag' => 1,
            'gift_flag' => 1,
            'oneday_flag' => 1,
            'icon_type' => 'S',
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'spr_font' => 0,
            'image' => $imageVar,
            'eximage' => $eximageVar,
            'title' => $request->input('title'),
            'contents' => $request->input('contents'),
            'old_price' => 0,
            'start_date' => Carbon::parse($request->input('start_date'))->format('Y-m-d'),
            'end_date' => Carbon::parse($request->input('end_date'))->format('Y-m-d'),
            'point' => 0,
        ];

        // dd($inputData);  
        // Jalankan prosedur NGM_PRODUCT_INS
        $productSeq = DB::connection('atlantica')->transaction(function () use ($inputData) {
            $result = DB::connection('atlantica')->table('dbo.NGM_PRODUCT')->insert($inputData);

            if (!$result) {
                throw new \Exception('Failed to insert NGM_PRODUCT');
            }

            return DB::connection('atlantica')->table('dbo.NGM_PRODUCT')->where('name', $inputData['name'])->first();
        });

        // Persiapkan data input untuk NGM_PRODUCT_ITEM_INS
        $itemData = [
            'product_seq' => $productSeq->product_seq,
            'item_unique' => $request->input('item_unique'),
            'item_num' => $request->input('item_num'),
            'item_name' => $productSeq->name,
            'UseDay' => 0,
        ];

        // Jalankan prosedur NGM_PRODUCT_ITEM_INS
        $results_item_product = DB::connection('atlantica')->table('dbo.NGM_PRODUCT_ITEM')->insert($itemData);

        if (!$results_item_product) {
            DB::connection('atlantica')->rollback();
            Session::flash('success', 'Add Product failed.');
            return redirect(route('product.index'));
        }

        // Jalankan prosedur NGM_PRODUCT_UPD_STATUS
        $update_item = DB::connection('atlantica')->insert("EXEC NGM_PRODUCT_UPD_STATUS @product_seq=?, @status=?", [
            $productSeq->product_seq,
            'S'
        ]);

        if (!$update_item) {
            DB::connection('atlantica')->rollback();
            Session::flash('success', 'Add Product failed.');
            return redirect(route('product.index'));
        }

        // Jika semuanya berhasil, commit transaksi
        DB::connection('atlantica')->commit();
        Session::flash('success', 'Add Product successful.');
        return redirect(route('product.index'));
    }
}
