<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\District;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::on('mysql_locations')->get();
        $districts = District::on('mysql_locations')->get();
        return view('locations.index', compact(
            'countries',
            'districts',
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
    public function store(StoreCountryRequest $request)
    {
        do {
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // Define the characters allowed in the ID
            $charactersLength = strlen($characters);
            $randomId = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomId .= $characters[rand(0, $charactersLength - 1)];
            }
            $existingCountry = Country::on('mysql_locations')->where('uid', $randomId)->first(); // Check if the ID exists
        } while ($existingCountry !== null);


        $country = new Country();
        $country->setConnection('mysql_locations');
        $country->country = $request->country;
        $country->slug = Str::slug($request->country);
        $country->uid = $randomId;
        $country->save();
        return redirect()->route('country.index')->with('success', 'New Country Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        $country->country = $request->input('country');
        $country->slug = Str::slug($request->input('country'));
        return redirect()->route('country.index')->with('success', 'The Country Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        
    }

    public function changeCountryStatus($country)
    {
        $this_country = Country::where('slug', $country)->first();

        if ($this_country) {
            if ($this_country->status == 1) {
                $this_country->where('slug', $country)->update(['status' => 0]);
            } else {
                $this_country->where('slug', $country)->update(['status' => 1]);
            }
            return redirect()->route('country.index')->with('success', 'Country status changed successfully');
        } else {
            return redirect()->route('country.index')->with('error', 'Country Not found');
        }
    }

}
