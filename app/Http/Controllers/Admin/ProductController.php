<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.product');
    }

    // public function store(Request $request)
    // {
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('assets/images/itemmall'), $imageName);
    //         $imageVar = $imageName;
    //     }

    //     if ($request->hasFile('eximage')) {
    //         $eximage = $request->file('eximage');
    //         $eximageName = time() . '_ex.' . $eximage->getClientOriginalExtension();
    //         $eximage->move(public_path('assets/images/itemmall'), $eximageName);
    //         $eximageVar = $eximageName;
    //     }

    //     $mainCategory = $request->input('main_category');
    //     $name = $request->input('name');
    //     $price = $request->input('price');
    //     $image = $request->input('image');
    //     $eximage = $request->input('eximage');
    //     $title = $request->input('title');
    //     $contents = $request->input('contents');
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     $item_unique = $request->input('item_unique');
    //     $item_num = $request->input('item_num');
    //     // dd($price);
    //     if ($price !== null && is_numeric($price)) {

    //         $result = DB::connection('atlantica')->insert("EXEC NGM_PRODUCT_INS @group_seq=?, @main_category=?, @sub_category=?, 
    //             @best_flag=?, @gift_flag=?, @oneday_flag=?, @icon_type=?, @name=?, @price=?, @spr_font=?, 
    //             @image=?, @eximage=?, @title=?, @contents=?, @old_price=?, @start_date=?, @end_date=?, @point=?", [
    //             1, // group_seq
    //             $mainCategory,
    //             1,
    //             1,
    //             1,
    //             1,
    //             'S',
    //             $name,
    //             $price,
    //             0,
    //             $imageVar,
    //             $eximageVar,
    //             $title,
    //             $contents,
    //             0, // old_price
    //             $startDate,
    //             $endDate,
    //             0, // point
    //         ]);

    //         // Ambil nilai product_seq yang baru dari hasil query di atas
    //         if ($result) {
    //             $productData = DB::connection('atlantica')->table('dbo.NGM_PRODUCT')->where('name', $name)->where('price', $price)->first();
    //             // dd($productSeq->product_seq);

    //             $results_item_product = DB::connection('atlantica')->table('dbo.NGM_PRODUCT_ITEM')->insert(
    //                 [
    //                     'product_seq' => $productData->product_seq,
    //                     'item_unique' => $item_unique,
    //                     'item_num' => $item_num,
    //                     'item_name' => $productData->name,
    //                     'UseDay' => 0,
    //                 ]
    //             );

    //             if ($results_item_product) {
    //                 $update_item = DB::connection('atlantica')->insert("EXEC NGM_PRODUCT_UPD_STATUS @product_seq=?, @status=?", [
    //                     $productData->product_seq,
    //                     'S'
    //                 ]);

    //                 if ($update_item) {
    //                     return redirect(route('product.index'));
    //                     Session::flash('success', 'Add Product successful.');
    //                 } else {
    //                     DB::rollBack();
    //                     Session::flash('success', 'Add Product failed.');
    //                     return redirect(route('product.index'));
    //                 }
    //             } else {
    //                 DB::rollBack();
    //                 Session::flash('success', 'Add Product failed.');
    //                 return redirect(route('product.index'));
    //             }
    //         } else {
    //             DB::rollBack();
    //             Session::flash('success', 'Add Product failed.');
    //             return redirect(route('product.index'));
    //         }
    //     } else {
    //         // Handle kesalahan karena $price tidak valid
    //         Session::flash('success', 'Add Product failed.');
    //         return redirect(route('product.index'));
    //     }
    // }
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
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'point' => 0,
        ];

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
