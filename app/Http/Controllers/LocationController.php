<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function locationIndex()
    {
        return view('locations.index');
    }

    public function tenantIndex()
    {
        return view('tenant.dashboard');
    }

}
