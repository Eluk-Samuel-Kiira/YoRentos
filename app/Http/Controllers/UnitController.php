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
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estates = Estate::on('mysql_estates')->where('status', 1)->get();        
        $units = Unit::on('mysql_estates')->latest()->get();        
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
        

        $unit = new Unit();
        $unit->setConnection('mysql_estates');
        $unit->unit = $request->unit;
        $unit->slug = Str::slug($request->unit . '-' . $randomId);
        $unit->estate_id = $request->estate_id;
        $unit->estate_uid = $request->estate_uid;
        $unit->rental_id = $request->rental_id;
        $unit->duration_id = $request->duration_id;
        $unit->price = $request->price;
        $unit->square_footage = $request->square_footage;
        $unit->room_no = $request->room_no;
        $unit->description = $request->description;
        $unit->resources = implode(',', $request->resources);
        $unit->uid = $randomId;
        $unit->save();
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
        $unit->update($request->validated());
        $unit->unit = $request->input('unit');
        $unit->duration_id = $request->input('duration_id');
        $unit->rental_id = $request->input('rental_id');
        $unit->rental_id = $request->input('rental_id');
        $unit->slug = Str::slug($request->input('unit') . '-' . $request->input('uid'));
        $unit->price = $request->input('price');
        $unit->square_footage = $request->input('square_footage');
        $unit->room_no = $request->input('room_no');
        $unit->description = $request->input('description');
        $unit->resources = implode(',', $request->input('resources'));
        return redirect()->route('unit.index')->with('success', 'The Rental Unit Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
    }

    public function updateTenant(Request $request)
    {
        $unit_id = $request->input('unit_id');
        $unit_uid = $request->input('unit_uid');
        $lease_start = $request->input('lease_start');
        $lease_stop = $request->input('lease_stop');
        $tenant_id = $request->input('tenant_id');

        $unit = Unit::where('id', $unit_id)->where('uid', $unit_uid)->first();
        if ($unit)
        {
            $unit->update([
                'tenant_id' => $tenant_id,
                'lease_start' => $lease_start,
                'lease_stop' => $lease_stop,
                'status' => 1,
            ]);
            return redirect()->route('unit.index')->with('success', 'Tenant Info Updated Successfully');
        } else {
            return redirect()->route('unit.index')->with('error', 'Unit Not Found or Registered');
        }
    }

    public function changeUnitStatus($slug)
    {
        $this_unit = Unit::where('slug', $slug)->first();

        if ($this_unit) {
            if ($this_unit->status == 1) {
                $this_unit->where('slug', $slug)->update(['status' => 0]);
            } else {
                $this_unit->where('slug', $slug)->update(['status' => 1]);
            }
            
            return redirect()->route('unit.index')->with('success', 'Unit Status Changed successfully');
        } else {
            return redirect()->route('unit.index')->with('error', 'Unit Not found');
        }
    }
}
