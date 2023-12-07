<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estate;
// use App\Models\Rental;

class LocationController extends Controller
{
    public function tenantIndex()
    {
        $estates = Estate::on('mysql_estates')->with('unitEstate')->where('status', 1)->latest()->get();

        return view('tenant.dashboard', compact(
            'estates',
        ));
    }

}
