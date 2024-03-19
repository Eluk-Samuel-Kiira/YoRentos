<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Http\Requests\StoreCountyRequest;
use App\Http\Requests\UpdateCountyRequest;
use App\Models\District;
use App\Models\Subcounty;
use Illuminate\Support\Str;

class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::on('mysql_locations')->latest()->get();
        $counties = County::on('mysql_locations')->latest()->get();
        $subcounties = Subcounty::on('mysql_locations')->latest()->get();
        return view('counties.index', compact(
            'districts',
            'counties',
            'subcounties',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountyRequest $request)
    {
        do {
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // Define the characters allowed in the ID
            $charactersLength = strlen($characters);
            $randomId = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomId .= $characters[rand(0, $charactersLength - 1)];
            }
            $existingCountry = County::on('mysql_locations')->where('uid', $randomId)->first(); // Check if the ID exists
        } while ($existingCountry !== null);


        $county = new County();
        $county->setConnection('mysql_locations');
        $county->county = $request->county;
        $county->district_id = $request->district_id;
        $county->slug = Str::slug($request->county);
        $county->uid = $randomId;
        $county->save();
        return redirect()->route('county.index')->with('success', 'New County Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(County $county)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(County $county)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountyRequest $request, County $county)
    {
        $county->update($request->validated());
        $county->county = $request->input('county');
        $county->district_id = $request->input('district_id');
        $county->slug = Str::slug($request->input('county'));
        return redirect()->route('county.index')->with('success', 'The County Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(County $county)
    {
        //
    }

    public function changeCountyStatus($county)
    {
        $this_county = County::where('slug', $county)->first();

        if ($this_county) {
            if ($this_county->status == 1) {
                $this_county->where('slug', $county)->update(['status' => 0]);
                return redirect()->route('county.index')->with('success', 'County Deactivated successfully');
            } else {
                $this_county->where('slug', $county)->update(['status' => 1]);
                return redirect()->route('county.index')->with('success', 'County Activated successfully');
            }
        } else {
            return redirect()->route('county.index')->with('error', 'County Not found');
        }
    }
}
