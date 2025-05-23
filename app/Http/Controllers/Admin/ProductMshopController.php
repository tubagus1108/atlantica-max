<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductMshopController extends Controller
{
    public function index()
    {
        return view('admin.mshop.mshop');
    }

    public function store(Request $request)
    {
        // Cek user session & hak akses admin
        $sessionUser = Session::get('user');

        if (!$sessionUser || !isset($sessionUser['MasterLevelValue']) || $sessionUser['MasterLevelValue'] != 120) {
            abort(403, 'Unauthorized access.');
        }

        // Validasi form input
        $request->validate([
            'itemid' => 'required',
            'name' => 'required',
            'category' => 'required',
            'desc' => 'required',
            'desc1' => 'required',
            'desc2' => 'required',
            'desc3' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageFileName = null;
        $extension = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = strtolower($image->getClientOriginalExtension());

            if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                return back()->with('error', 'Format gambar harus JPG atau PNG.');
            }

            // Buat nama unik
            $imageFileName = $request->input('name') . '.' . $extension;

            // Path simpan
            $destination = base_path('assets/images/itemmall/m_shop');
            $image->move($destination, $imageFileName);
        }

        // Persiapkan data input
        $inputData = [
            'itemid' => $request->input('itemid'),
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'itemcount' => 99999999,
            'price' => $request->input('price'),
            'price_sale' => 0,
            'category' => $request->input('category'),
            'purchases' => 0,
            'image' => $imageFileName ? ('.' . $extension) : null,
            'isbundle' => 0,
            'forsale' => 1,
            'desc1' => $request->input('desc1'),
            'desc2' => $request->input('desc2'),
            'desc3' => $request->input('desc3'),
            'typeshop' => 'M-Shop'
        ];
        try {
            DB::connection('atlantica')->beginTransaction();
            $inputData['id'] = DB::connection('atlantica')->table('dbo.A_BOND')->max('id') + 1;
            DB::connection('atlantica')->table('dbo.A_BOND')->insert($inputData);
            DB::connection('atlantica')->commit();

            Session::flash('success', 'Add Product Mshop successful.');
            return redirect()->route('product.index');
        } catch (\Exception $e) {
            dd($e);
            DB::connection('atlantica')->rollBack();
            return back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }
}
