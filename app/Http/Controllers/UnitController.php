<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Estate;
use App\Models\Duration;
use App\Models\User;
use App\Models\Rental;
use App\Models\Resource;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use Illuminate\Support\Str;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estates = Estate::on('mysql_estates')->where('status', 1)->get();        
        $units = Unit::on('mysql_estates')->get();        
        $durations = Duration::on('mysql_estates')->where('status', 1)->get();
        $rentals = Rental::on('mysql_estates')->where('status', 1)->get();
        $resources = Resource::on('mysql_estates')->where('status', 1)->get();
        $users = User::on('mysql')->where('status', 1)->whereNot('role', 'Admin')->get();

        return view('units.index', compact(
            'estates',
            'durations',
            'users',
            'rentals',
            'resources',
            'units',
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
    public function store(StoreUnitRequest $request)
    {
        do {
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXWYZ~@#$%^&*()_+=-?/\|'; // Define the characters allowed in the ID
            $charactersLength = strlen($characters);
            $randomId = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomId .= $characters[rand(0, $charactersLength - 1)];
            }
            $existingId = Unit::on('mysql_estates')->where('uid', $randomId)->first(); // Check if the ID exists
        } while ($existingId !== null);
        

        $estate = new Unit();
        $estate->setConnection('mysql_estates');
        $estate->unit = $request->unit;
        $estate->slug = Str::slug($request->unit);
        $estate->estate_id = $request->estate_id;
        $estate->estate_uid = $request->estate_uid;
        $estate->rental_id = $request->rental_id;
        $estate->duration_id = $request->duration_id;
        $estate->price = $request->price;
        $estate->square_footage = $request->square_footage;
        $estate->room_no = $request->room_no;
        $estate->description = $request->description;
        $estate->resources = implode(',', $request->resources);
        $estate->uid = $randomId;
        $estate->save();
        return redirect()->route('unit.index')->with('success', 'New Unit Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
