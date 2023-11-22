<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function tenantIndex()
    {
        return view('tenant.dashboard');
    }

}
