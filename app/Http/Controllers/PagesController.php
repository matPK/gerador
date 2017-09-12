<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function overview(){
        return view('pages.overview');
    }
}
