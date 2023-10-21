<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function newsIndex()
    {
        return view('admin.news.news');
    }
    public function store(Request $request)
    {
        // Validasi data formulir
        $validatedData = $request->validate([
            'lang' => 'required',
            'title' => 'required',
            'type' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Simpan gambar (upload) ke direktori yang sesuai
        $imagePath = $request->file('image')->store('images', 'public');

        // Buat entitas News dan simpan ke database
        $news = new News();
        $news->lang = $validatedData['lang'];
        $news->title = $validatedData['title'];
        $news->type = $validatedData['type'];
        $news->content = $validatedData['content'];
        $news->image = $imagePath;
        $news->save();

        return redirect(route('admin.news'))->with('success', 'News created successfully');
    }
}
