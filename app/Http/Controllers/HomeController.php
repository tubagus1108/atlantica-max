<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        dd(Auth::check());
        if (Auth::check()) {
            return view('home.index');
        } else {
            return redirect()->route('login.index');
        }
    }
}
