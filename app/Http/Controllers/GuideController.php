<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuideController extends Controller
{
    //GUIDE ENGLISH
    public function guide_english(){
        return view('guide.eng');
    }
}
