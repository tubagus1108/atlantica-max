<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('user')) {
            return view('home.index');
        } else {
            return redirect()->route('login.index');
        }
    }
}
