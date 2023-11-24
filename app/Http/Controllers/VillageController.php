<?php

namespace App\Http\Controllers;

use App\Models\Village;
use App\Http\Requests\StoreVillageRequest;
use App\Http\Requests\UpdateVillageRequest;
use Illuminate\Support\Str;

class VillageController extends Controller
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
    public function store(StoreVillageRequest $request)
    {
        do {
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // Define the characters allowed in the ID
            $charactersLength = strlen($characters);
            $randomId = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomId .= $characters[rand(0, $charactersLength - 1)];
            }
            $existingId = Village::on('mysql_locations')->where('uid', $randomId)->first(); // Check if the ID exists
        } while ($existingId !== null);


        $village = new Village();
        $village->setConnection('mysql_locations');
        $village->village = $request->village;
        $village->parish_id = $request->parish_id;
        $village->slug = Str::slug($request->village);
        $village->uid = $randomId;
        $village->save();
        return redirect()->route('parish.index')->with('success', 'New Parish/Ward Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Village $village)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Village $village)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVillageRequest $request, Village $village)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Village $village)
    {
        //
    }

    public function changevillageStatus($village)
    {
        $this_village = Village::where('slug', $village)->first();

        if ($this_village) {
            if ($this_village->status == 1) {
                $this_village->where('slug', $village)->update(['status' => 0]);
                return redirect()->route('parish.index')->with('success', 'Village Deactivated successfully');
            } else {
                $this_village->where('slug', $village)->update(['status' => 1]);
                return redirect()->route('parish.index')->with('success', 'Village Activated successfully');
            }
        } else {
            return redirect()->route('parish.index')->with('error', 'Village Not found');
        }
    }
}
