<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemMallController extends Controller
{
    //
    public function index()
    {
        return view('users.item-mall');
    }
}
