<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function redirect()
    {
        return true;
    }

    public function index()
    {
        return view('frontend.home');
    }
}
