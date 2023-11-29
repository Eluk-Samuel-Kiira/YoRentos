<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Http\Requests\StoreEstateRequest;
use App\Http\Requests\UpdateEstateRequest;
use Illuminate\Support\Str;


class EstateController extends Controller
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
    public function store(StoreEstateRequest $request)
    {
        do {
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // Define the characters allowed in the ID
            $charactersLength = strlen($characters);
            $randomId = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomId .= $characters[rand(0, $charactersLength - 1)];
            }
            $existingId = Estate::on('mysql_estates')->where('uid', $randomId)->first(); // Check if the ID exists
        } while ($existingId !== null);

        $estate = new Estate();
        $estate->setConnection('mysql_estates');
        $estate->estate = $request->estate;
        $estate->slug = Str::slug($request->estate);
        $estate->landlord_id = $request->landlord_id;
        $estate->rental_id = $request->rental_id;
        $estate->broker_id = $request->broker_id;
        $estate->village_id = $request->village_id;
        $estate->uid = $randomId;
        $estate->save();
        return redirect()->route('rental.index')->with('success', 'New Estate Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estate $estate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estate $estate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstateRequest $request, Estate $estate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estate $estate)
    {
        //
    }

    public function changeEstateStatus($estate)
    {
        $this_estate = Estate::where('slug', $estate)->first();

        if ($this_estate) {
            if ($this_estate->status == 1) {
                $this_estate->where('slug', $estate)->update(['status' => 0]);
            } else {
                $this_estate->where('slug', $estate)->update(['status' => 1]);
            }
            
            return redirect()->route('rental.index')->with('success', 'Estate Status Changed successfully');
        } else {
            return redirect()->route('rental.index')->with('error', 'Estate Not found');
        }
    }
}

