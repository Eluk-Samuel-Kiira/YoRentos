<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use Illuminate\Support\Str;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rentals.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rental = Rental::latest()->get();
        
        return response()->json([
            'rental' => $rental,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRentalRequest $request)
    {
        $rental = new Rental();
        $rental->name = $request->name;
        $rental->slug = Str::slug($request->name);
        $rental->save();
        return redirect()->route('rental.index')->with('success', 'New Rental Type Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        //
    }

    public function unitDetails()
    {
        return view('tenant.estate-unit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRentalRequest $request, Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        //
    }

    public function rentalStatus($id)
    {
        $rental = Rental::where('id', $id)->first();

        if ($rental) {
            if ($rental->status == 1) {
                $rental->where('id', $id)->update(['status' => 0]);
            } else {
                $rental->where('id', $id)->update(['status' => 1]);
            }
            
            return redirect()->route('rental.index')->with('success', 'Rental Status Changed successfully');
        } else {
            return redirect()->route('rental.index')->with('error', 'Rental Not found');
        }
    }

    public function deleteRental($rental_id)
    {
        $rental = Rental::where('id', $rental_id)->first();
        if ($rental) {
            $rental->delete();
            
            return redirect()->route('rental.index')->with('success', 'Rental DELETED successfully');
        } else {
            return redirect()->route('rental.index')->with('error', 'Rental Not found');
        }
    }

}
