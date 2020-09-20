<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enumeration\BannerType;

class FrontController extends Controller
{
    //
    public function index() {
        $x = BannerType::$MAIN_BANNER; 
        return view('pages.home', compact([]));
    }
}
