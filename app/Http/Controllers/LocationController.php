<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estate;
use App\Models\Rental;

class LocationController extends Controller
{
    public function tenantIndex()
    {
        $estates = Estate::on('mysql_estates')->with('unitEstate')->where('status', 1)->latest()->get();

        return view('tenant.dashboard', compact(
            'estates',
        ));
    }

    public function showEstate($slug)
    {
        $estate = Estate::on('mysql_estates')->with('unitEstate','rentalName')
                            ->where('status', 1)->where('slug', $slug)->first();

        if($estate)
        {
            return view('tenant.estate-unit', compact(
                'estate',
            ));
        } else {
            return redirect()->route('tenant.dashboard')->with('error', 'This Estate Not Found');
        }
   
    }

    public function showRental($slug)
    {
        $rental_id = Rental::on('mysql_estates')->where('status', 1)->where('slug', $slug)->first();
        $rental_id = $rental_id->id;
        if ($rental_id)
        {
            // dd($rental_id);
            $rental_type = Estate::on('mysql_estates')->where('status', 1)->where('rental_id', $rental_id)->get();
            return view('tenant.rental-type', compact(
                'rental_type'
            ));
        } else {
            return redirect()->route('tenant.dashboard')->with('error', 'Not Accessible at the Moment');
        }
    }

    public function locationRental($slug)
    {
        $rental_location = Estate::on('mysql_estates')->where('slug', $slug)->where('status', 1)
                            ->whereNotNull('latitude')->whereNotNull('latitude')->first();
        if ($rental_location)
        {
            return view('tenant.location', compact(
                'rental_location',
            ));
        } else {
            return redirect()->route('tenant.dashboard')->with('error', 'Location Details Unavailable!');
        }
    }
    
}
