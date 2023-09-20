<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function information(Request $request){
        if ($request->session()->get('user')) {
            return view('users.information');
        } else {
            return redirect()->route('login.index');
        }
    }
}
