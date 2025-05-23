<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function newsIndex(Request $request)
    {
        $sessionUser = Session::get('user');

        if (!$sessionUser || !isset($sessionUser['MasterLevelValue']) || $sessionUser['MasterLevelValue'] != 120) {
            abort(403, 'Unauthorized access.');
        }

        return view('admin.news.news');
    }

    public function store(Request $request)
    {
        $sessionUser = Session::get('user');

        if (!$sessionUser || !isset($sessionUser['MasterLevelValue']) || $sessionUser['MasterLevelValue'] != 120) {
            abort(403, 'Unauthorized access.');
        }

        $validatedData = $request->validate([
            'lang' => 'required|string|in:id,en',
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $slugTitle = Str::slug($validatedData['title']);
            $imageName = time() . '-' . $slugTitle . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/news'), $imageName);
        } else {
            return back()->with('error', 'Gambar tidak ditemukan.');
        }

        $news = new News();
        $news->lang = $validatedData['lang'];
        $news->title = $validatedData['title'];
        $news->type = $validatedData['type'];
        $news->content = $validatedData['content'];
        $news->image = $imageName;
        $news->save();

        return redirect(route('admin.news'))->with('success', 'News created successfully.');
    }
}
