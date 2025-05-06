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

        $imageFileName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = strtolower($image->getClientOriginalExtension());

            // Validasi ekstensi
            if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                return back()->with('error', 'Format gambar harus JPG atau PNG.');
            }

            // Buat nama unik
            $imageFileName = $request->input('name') . '.' . $extension;

            // Pindahkan file
            $image->move(public_path('assets/images/itemmall/img_shop'), $imageFileName);
        }

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
            'image' => '.' . $extension, // Simpan nama file gambar
            'isbundle' => 0,
            'forsale' => 1,
            'desc1' => $request->input('desc1'),
            'desc2' => $request->input('desc2'),
            'desc3' => $request->input('desc3'),
            'min_qty' => $request->input('min_qty'),
            'max_qty' => $request->input('max_qty'),
        ];

        // Jalankan prosedur NGM_PRODUCT_INS
        $nextId = DB::connection('atlantica')->table('dbo.A_CASH')->max('id') + 1;
        $inputData['id'] = $nextId;

        DB::connection('atlantica')->beginTransaction(); // pastikan transaksi dimulai

        try {
            DB::connection('atlantica')->table('dbo.A_CASH')->insert($inputData);
            DB::connection('atlantica')->commit();
            Session::flash('success', 'Add Product successful.');
            return redirect(route('product.index'));
        } catch (\Exception $e) {
            DB::connection('atlantica')->rollBack();
            return back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }

}
