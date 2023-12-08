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

    public function showEstate($estate_uri)
    {
        $this_estate = Estate::on('mysql_estates')->with('unitEstate')->where('status', 0)->where('slug', $estate_uri)->first();
        if($this_estate)
        {
            return view('tenant.estate-unit', compact(
                'this_estate',
            ));
        } else {
            return redirect()->route('tenant.dashboard')->with('error', 'This Estate Not Found');
        }
   
    }

    
}
