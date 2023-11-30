<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Models\User;
use App\Http\Requests\StoreEstateRequest;
use App\Http\Requests\UpdateEstateRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Validator;


class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estates = Estate::on('mysql_estates')->get();
        $users = User::on('mysql')->get();
        return view('estates.index', compact(
            'estates',
            'users',
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
        return view('estates.index', compact('estate'));
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
        $estate->update($request->validated());
        $estate->estate = $request->input('estate');
        $estate->village_id = $request->input('village_id');
        $estate->broker_id = $request->input('broker_id');
        $estate->rental_id = $request->input('rental_id');
        $estate->slug = Str::slug($request->input('estate'));
        return redirect()->route('rental.index')->with('success', 'The Estate Block Has Been Updated Successfully');
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

    public function videoUpdate(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'video' => 'required|file|mimes:mp4|max:20480', 
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $estate = Estate::where('landlord_id', $request->landlord_id)->where('uid', $request->estate_id)->first();
        if ($estate)
        {
            $video = $request->file('video');
            if ($video != null) {
                $db_video = 'app/public/estate_videos/'.$estate->video;
                $per_video = storage_path($db_video);

                if(File::exists($per_video)) {
                    File::delete($per_video);
                }

                $videoName = time().'.'.$video->extension();
                $video->move(storage_path('app/public/estate_videos'),$videoName);
                $estate->update(['video' => $videoName]);

                return redirect()->route('estate.index')->with('success', 'Estate Video Added successfully');
            }else {
                return redirect()->route('estate.index')->with('error', 'An Error Occured');
            }
        } else {
            return redirect()->route('estate.index')->with('error', 'Estate Not found');
        }
    }

}

