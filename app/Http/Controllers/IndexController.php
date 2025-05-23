<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function IndexPage()
    {
        return view('index');
    }
}
