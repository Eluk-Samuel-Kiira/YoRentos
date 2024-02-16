<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Estate;
use App\Models\User;
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
        $rentals = Rental::on('mysql_estates')->get();
        $estates = Estate::on('mysql_estates')->get();
        $users = User::on('mysql')->get();
        return view('rentals.index', compact(
            'rentals',
            'estates',
            'users',
        ));
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
        $rental->setConnection('mysql_estates');
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


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRentalRequest $request, Rental $rental)
    {
        $rental->update($request->validated());
        $rental->name = $request->input('name');
        $rental->slug = Str::slug($request->input('name'));
        if ($rental) {
            return response()->json(['success' => true, 'message' => 'The Rental Type Has Been Updated Successfully']);
        }else {
            return response()->json(['success' => false, 'message' => 'An error occurred']);        
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        //
    }

    public function rentalStatus($rental_slug)
    {
        $rental = Rental::where('slug', $rental_slug)->first();

        if ($rental) {
            if ($rental->status == 1) {
                $rental->where('slug', $rental_slug)->update(['status' => 0]);
            } else {
                $rental->where('slug', $rental_slug)->update(['status' => 1]);
            }
            
            return redirect()->route('rental.index')->with('success', 'Rental Status Changed successfully');
        } else {
            return redirect()->route('rental.index')->with('error', 'Rental Not found');
        }
    }

    public function rentalCharts()
    {
        $rentals = Rental::with('rentalUnits')->get();
            
        return response()->json([
            'rentals' => $rentals,
        ]);
    }
}
