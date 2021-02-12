<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KubAT\PhpSimple\HtmlDomParser;


class FrontendController extends Controller
{

    public function index()
    {
        return view('frontend.index');
    }
}