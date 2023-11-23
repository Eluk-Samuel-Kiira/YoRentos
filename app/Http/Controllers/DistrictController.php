<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use Illuminate\Support\Str;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreDistrictRequest $request)
    {
        //dd('yes');
        do {
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // Define the characters allowed in the ID
            $charactersLength = strlen($characters);
            $randomId = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomId .= $characters[rand(0, $charactersLength - 1)];
            }
            $existingCountry = District::on('mysql_locations')->where('uid', $randomId)->first(); // Check if the ID exists
        } while ($existingCountry !== null);


        $district = new District();
        $district->setConnection('mysql_locations');
        $district->district = $request->district;
        $district->country_id = $request->country_id;
        $district->slug = Str::slug($request->district);
        $district->uid = $randomId;
        $district->save();
        return redirect()->route('country.index')->with('success', 'New District Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistrictRequest $request, District $district)
    {
        $district->update($request->validated());
        $district->district = $request->input('district');
        $district->country_id = $request->input('country_id');
        $district->slug = Str::slug($request->input('district'));
        return redirect()->route('country.index')->with('success', 'The District Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        //
    }

    public function changeDistrictStatus($district)
    {
        $this_district = District::where('slug', $district)->first();

        if ($this_district) {
            if ($this_district->status == 1) {
                $this_district->where('slug', $district)->update(['status' => 0]);
            } else {
                $this_district->where('slug', $district)->update(['status' => 1]);
            }
            
            return redirect()->route('country.index')->with('success', 'District Activated successfully');
        } else {
            return redirect()->route('country.index')->with('error', 'District Not found');
        }
    }
}
