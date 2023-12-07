<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estate;
use App\Models\Unit;


class LandingPageController extends Controller
{
    public function index()
    {        
        $estates = Estate::on('mysql_estates')->with('unitEstate')->where('status', 1)->latest()->get();
        // $units = Unit::on('mysql_estates')->where('status', 0)->latest()->get();

        return view('landing_page.home', compact(
            'estates',
        ));
    }
}
