<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexCkeditorController extends Controller
{
    public function index()
    {
        return view('ckeditor.index');
    }
}
