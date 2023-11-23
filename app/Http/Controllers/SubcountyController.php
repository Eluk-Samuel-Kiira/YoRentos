<?php

namespace App\Http\Controllers;

use App\Models\Subcounty;
use App\Http\Requests\StoreSubcountyRequest;
use App\Http\Requests\UpdateSubcountyRequest;
use Illuminate\Support\Str;

class SubcountyController extends Controller
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
    public function store(StoreSubcountyRequest $request)
    {
        do {
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // Define the characters allowed in the ID
            $charactersLength = strlen($characters);
            $randomId = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomId .= $characters[rand(0, $charactersLength - 1)];
            }
            $existingCountry = Subcounty::on('mysql_locations')->where('uid', $randomId)->first(); // Check if the ID exists
        } while ($existingCountry !== null);


        $subcounty = new Subcounty();
        $subcounty->setConnection('mysql_locations');
        $subcounty->subcounty = $request->subcounty;
        $subcounty->county_id = $request->county_id;
        $subcounty->slug = Str::slug($request->subcounty);
        $subcounty->uid = $randomId;
        $subcounty->save();
        return redirect()->route('county.index')->with('success', 'New Subcounty/Division Created Successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcounty $subcounty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcounty $subcounty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubcountyRequest $request, Subcounty $subcounty)
    {
        $subcounty->update($request->validated());
        $subcounty->subcounty = $request->input('subcounty');
        $subcounty->county_id = $request->input('county_id');
        $subcounty->slug = Str::slug($request->input('subcounty'));
        return redirect()->route('county.index')->with('success', 'The Subcounty Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcounty $subcounty)
    {
        //

    }

    public function changeSubcountyStatus($subcounty)
    {
        $this_subcounty = Subcounty::where('slug', $subcounty)->first();

        if ($this_subcounty) {
            if ($this_subcounty->status == 1) {
                $this_subcounty->where('slug', $subcounty)->update(['status' => 0]);
                return redirect()->route('county.index')->with('success', 'County Deactivated successfully');
            } else {
                $this_subcounty->where('slug', $subcounty)->update(['status' => 1]);
                return redirect()->route('county.index')->with('success', 'Subcounty/Division Activated successfully');
            }
        } else {
            return redirect()->route('county.index')->with('error', 'Sub-County Not found');
        }
    }
}
