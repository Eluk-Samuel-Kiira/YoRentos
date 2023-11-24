<?php

namespace App\Http\Controllers;

use App\Models\Parish;
use App\Http\Requests\StoreParishRequest;
use App\Http\Requests\UpdateParishRequest;
use App\Models\Subcounty;
use Illuminate\Support\Str;
use App\Models\Village;

class ParishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcounties = Subcounty::on('mysql_locations')->get();
        $parishes = Parish::on('mysql_locations')->get();
        $villages = Village::on('mysql_locations')->get();
        return view('parishes.index', compact(
            'subcounties',
            'parishes',
            'villages',
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
    public function store(StoreParishRequest $request)
    {   
        do {
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // Define the characters allowed in the ID
            $charactersLength = strlen($characters);
            $randomId = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomId .= $characters[rand(0, $charactersLength - 1)];
            }
            $existingCountry = Parish::on('mysql_locations')->where('uid', $randomId)->first(); // Check if the ID exists
        } while ($existingCountry !== null);


        $parish = new Parish();
        $parish->setConnection('mysql_locations');
        $parish->parish = $request->parish;
        $parish->subcounty_id = $request->subcounty_id;
        $parish->slug = Str::slug($request->parish);
        $parish->uid = $randomId;
        $parish->save();
        return redirect()->route('parish.index')->with('success', 'New Village Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Parish $parish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parish $parish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParishRequest $request, Parish $parish)
    {
        $parish->update($request->validated());
        $parish->parish = $request->input('parish');
        $parish->subcounty_id = $request->input('subcounty_id');
        $parish->slug = Str::slug($request->input('parish'));
        return redirect()->route('parish.index')->with('success', 'The Parish/Ward Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parish $parish)
    {
        //
    }

    public function changeParishStatus($parish)
    {
        $this_parish = Parish::where('slug', $parish)->first();

        if ($this_parish) {
            if ($this_parish->status == 1) {
                $this_parish->where('slug', $parish)->update(['status' => 0]);
                return redirect()->route('parish.index')->with('success', 'Parish/Ward Deactivated successfully');
            } else {
                $this_parish->where('slug', $parish)->update(['status' => 1]);
                return redirect()->route('parish.index')->with('success', 'Parish/Ward Activated successfully');
            }
        } else {
            return redirect()->route('parish.index')->with('error', 'Parish/Ward Not found');
        }
    }
}
