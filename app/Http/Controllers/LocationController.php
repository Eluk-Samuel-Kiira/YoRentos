<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estate;
use App\Models\Rental;
use App\Models\Unit;
use App\Models\User;
use DB;

class LocationController extends Controller
{
    public function tenantIndex()
    {       
        $user = User::where('id', auth()->user()->id)->first();
        $user_lat = $user->latitude;
        $user_lng = $user->longitude;

        $estates = Estate::on('mysql_estates')->with('unitEstate')->where('status', 1)->select('*')
        ->selectRaw(
            '( 6371 * acos( cos( radians(?) ) *
            cos( radians( latitude ) ) *
            cos( radians( longitude ) - radians(?) ) +
            sin( radians(?) ) *
            sin( radians( latitude ) ) ) ) AS distance',
            [$user_lat, $user_lng, $user_lat]
        )
        ->having('distance', '<=', 20) // 20km range
        ->orderBy('distance', 'asc')->latest()->get();

        $newly_estates = Estate::on('mysql_estates')->with('unitEstate')->where('status', 1)->latest()->take(6)->get();
        $early_estates = Estate::on('mysql_estates')->with('unitEstate')->where('status', 1)->latest()->skip(6)->take(6)->get();

        return view('tenant.dashboard', compact(
            'estates',
            'newly_estates',
            'early_estates',
        ));
    }

    public function showEstate($slug)
    {
        $estate = Estate::on('mysql_estates')->with('unitEstate','rentalName')
                            ->where('status', 1)->where('slug', $slug)->first();
        $users = User::where('status', 1)->get();

        if($estate) {
            $images = explode(',', $estate->images);
            if(count($images) > 0) {
                $firstImage = $images[0];
            }
        
            // Share buttons
            $estateShare = [
                'ogTitle' => $estate->estate,
                'ogDescription' => $estate->description,
                'ogImage' => isset($firstImage) ? $firstImage : null,
            ];
            
            $description = $estate->description;
            if (empty($description)) {
                $description = 'Checkout This Amazing Apartment';
            }
            $shareButtons = \Share::page(
                url(request()->fullUrl())  . "\n",
                $description, 
            )
            ->facebook()
            ->telegram()
            ->linkedin()
            ->whatsapp()
            ->reddit()
            ->twitter()
            ->pinterest();
        
            // Update the unit number
            $estate->where('slug', $slug)->update([
                'unit_no' => DB::raw('unit_no + 1'),
            ]);
        
            // Return the view with data
            return view('tenant.estate-unit', compact(
                'estate', 
                'users', 
                'estateShare',
                'shareButtons'
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
        $users = User::where('status', 1)->get();
        $rental_location = Estate::on('mysql_estates')->where('slug', $slug)->where('status', 1)
                            ->whereNotNull('latitude')->whereNotNull('latitude')->first();
        if ($rental_location)
        {
            return view('tenant.location', compact(
                'rental_location',
                'users',
            ));
        } else {
            return redirect()->back()->with('error', 'Location Details Unavailable!');
        }
    }

    public function myUnit()
    {
        $units = Unit::where('tenant_id', auth()->user()->id)->where('status', 1)->get();
        if ($units)
        {
            return view('tenant.units', compact(
                'units',
            ));
        }else {
            return redirect()->back()->with('error', 'You are Not Assigned any Unit or Room, Contact Landlords Please');
        }
    }
    
}
