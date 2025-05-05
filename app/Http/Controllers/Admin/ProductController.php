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
            'itemid' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'desc1' => 'required',
            'desc2' => 'required',
            'desc3' => 'required',
            'min_qty' => 'required|min:1',
            'max_qty' => 'required|max:1000',
            'price' => 'required|numeric',
        ]);

        $imageVar = null;
        $eximageVar = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageVar = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/itemmall'), $imageVar);
        }

        // if ($request->hasFile('eximage')) {
        //     $eximage = $request->file('eximage');
        //     $eximageVar = time() . '_ex.' . $eximage->getClientOriginalExtension();
        //     $eximage->move(public_path('assets/images/itemmall'), $eximageVar);
        // }

        // Persiapkan data input
        $inputData = [
            'itemid' => $request->input('itemid'),
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'itemcount' => 99999999,
            'price' => $request->input('price'),
            'price_sale' => 0,
            'category' => 'a',
            'purchases' => 0,
            'image' => $imageVar,
            'isbundle' => 0,
            'forsale' => 1,
            'desc1' => $request->input('desc1'),
            'desc2' => $request->input('desc2'),
            'desc3' => $request->input('desc3'),
            'min_qty' =>  $request->input('min_qty'),
            'max_qty' => $request->input('max_qty'),
        ];

        // dd($inputData);  
        // Jalankan prosedur NGM_PRODUCT_INS
        $nextId = DB::connection('atlantica')->table('dbo.A_CASH')->max('id') + 1;
        $inputData['id'] = $nextId;
        $productSeq = DB::connection('atlantica')->transaction(function () use ($inputData) {
            $result = DB::connection('atlantica')->table('dbo.A_CASH')->insert($inputData);
        
            if (!$result) {
                throw new \Exception('Failed to insert A_CASH');
            }
        
            return DB::connection('atlantica')->table('dbo.A_CASH')->where('id', $inputData['id'])->first();
        });

        // // Persiapkan data input untuk NGM_PRODUCT_ITEM_INS
        // $itemData = [
        //     'product_seq' => rand(0,9999),
        //     'item_unique' => $request->input('itemid'),
        //     'item_num' => 99999999,
        //     'item_name' => $productSeq->name,
        //     'UseDay' => 0,
        // ];

        // // Jalankan prosedur NGM_PRODUCT_ITEM_INS
        // $results_item_product = DB::connection('atlantica')->table('dbo.NGM_PRODUCT_ITEM')->insert($itemData);

        // if (!$results_item_product) {
        //     DB::connection('atlantica')->rollback();
        //     Session::flash('success', 'Add Product failed.');
        //     return redirect(route('product.index'));
        // }

        // // Jalankan prosedur NGM_PRODUCT_UPD_STATUS
        // $update_item = DB::connection('atlantica')->insert("EXEC NGM_PRODUCT_UPD_STATUS @product_seq=?, @status=?", [
        //     $itemData['product_seq'],
        //     'S'
        // ]);

        // if (!$update_item) {
        //     DB::connection('atlantica')->rollback();
        //     Session::flash('success', 'Add Product failed.');
        //     return redirect(route('product.index'));
        // }

        // Jika semuanya berhasil, commit transaksi
        DB::connection('atlantica')->commit();
        Session::flash('success', 'Add Product successful.');
        return redirect(route('product.index'));
    }
}
