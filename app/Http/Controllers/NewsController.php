<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
    private $lang;

    public function index(Request $request)
    {
        if ($request->session()->get('locale') == null) {
            $this->lang = "en";
        } else {
            $this->lang = $request->session()->get('locale');
        }

        $data = News::where('lang', $this->lang)
            ->orderBy('created_at', 'desc') // Sort by created_at column in descending order
            ->paginate(2); // Paginate by 2 articles per page
        return view('news.detail_news', compact('data'));
    }

    public function datatable_news(Request $request)
    {
        $data = News::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function ($data) {
                $image = asset('storage/' . $data->image);
                return '<img src="' . $image . '" alt="Nama Alternatif" width="50%">';
            })
            ->addColumn('action', function ($data) {
                $edit_link = "'" . url('admin/news/edit/' . $data['id']) . "'";

                $btn = '<button  key="' . $data->id . '"  class="btn btn-info p-1 text-white" data-toggle="modal" data-target="#editNews" onclick="editNews(' . $edit_link . ')">Edit</button>';

                $btn = $btn . ' <a href="' . route('news.deleted', $data->id) . '" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }

    public function editForm($id)
    {
        $data = News::find($id);
        return view('admin.news.edit_news', compact('data'));
    }

    public function editFormPost(Request $request, $id)
    {
        // Validasi data formulir
        $validatedData = $request->validate([
            'lang' => 'required',
            'title' => 'required',
            'type' => 'required',
            'content' => 'required',
        ]);

        // Cek apakah ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif',
            ]);

            // Simpan gambar (upload) ke direktori yang sesuai
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            // Jika tidak ada gambar baru, gunakan gambar yang ada di database
            $imagePath = $request->image;
        }

        // Perbarui entitas News dan simpan ke database
        $news = News::find($request->id);
        $news->lang = $validatedData['lang'];
        $news->title = $validatedData['title'];
        $news->type = $validatedData['type'];
        $news->content = $validatedData['content'];
        $news->image = $imagePath;
        $news->save();

        return redirect(route('admin.news'))->with('success', 'News edit successfully');
    }

    public function deleted($id)
    {
        $data = News::find($id)->delete();

        if ($data) {
            return redirect(route('admin.news'));
        }
    }
}
