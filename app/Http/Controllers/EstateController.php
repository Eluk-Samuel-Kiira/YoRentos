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
        $estates = Estate::on('mysql_estates')->where('status', 1)->get();
        $users = User::on('mysql')->where('status', 1)->get();
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

    public function imageUpload(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'images' => 'required|array|max:10', // Assuming a maximum of 10 images are allowed
            'images.*' => 'file|mimes:png,jpeg,jpg,gif|max:5120'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $estate = Estate::where('landlord_id', $request->landlord_id)->where('uid', $request->estate_id)->first();

        if ($estate) {
            $currentImages = $estate->images;
            if ($currentImages)
            {
                $imageArray = explode(',', $currentImages);
                $imageCount = count($imageArray);
                if ($imageCount > 10)
                {
                    return redirect()->route('estate.index')->with('error', 'Images should not exceed 10, Kindly delete others');
                }
            }
            
            $images = $request->file('images');

            if ($images != null) {
                $updatedImages = $currentImages; 

                foreach ($images as $image) {
                    $length = 10;
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // Define the characters allowed in the ID
                    $charactersLength = strlen($characters);
                    $randomId = '';
                
                    for ($i = 0; $i < $length; $i++) {
                        $randomId .= $characters[rand(0, $charactersLength - 1)];
                    }

                    $imageExtension = $image->extension();
                    $imageName = $randomId.'.'.$imageExtension;
                    $image->move(storage_path('app/public/estate_images/' . $request->landlord_id), $imageName);

                    if ($updatedImages) {
                        $updatedImages .= ',' . $imageName; 
                    } else {
                        $updatedImages = $imageName; 
                    }
                }

                $estate->update(['images' => $updatedImages]);
                return redirect()->route('estate.index')->with('success', 'Estate Images Added successfully');
            } else {
                return redirect()->route('estate.index')->with('error', 'No images were uploaded');
            }
        } else {
            return redirect()->route('estate.index')->with('error', 'Estate Not found');
        }

    }

    public function deleteImage(Request $request)
    {
        $imageName = $request->input('image');
        $landlord_id = $request->input('estateLandlordId');
        $estate_id = $request->input('estateUid');
        
        $estate = Estate::where('landlord_id', $landlord_id)->where('uid', $estate_id)->first();

        $imagePath = 'app/public/estate_images/'.$landlord_id .'/'. $imageName;
        $per_image = storage_path($imagePath);

        if (File::exists($per_image)) {
            File::delete($per_image);
            $imageArray = explode(',', $estate->images);
            // Find and remove the deleted image name from the array
            if (($key = array_search($imageName, $imageArray)) !== false) {
                unset($imageArray[$key]);
            }
            
            $updatedImages = implode(',', $imageArray);
            $estate->update(['images' => $updatedImages]);

            // Return a JSON response indicating success
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Image not found or unable to delete.']);
    }

    public function estateLocation(Request $request)
    {
        $latitude = $request->input('estate_latitude');
        $longitude = $request->input('estate_longitude');
        $landlord_id = $request->input('estate_landlord');
        $estate_id = $request->input('estate_uid');
        
        $estate = Estate::where('landlord_id', $landlord_id)->where('uid', $estate_id)->first();
        if ($estate)
        {
            $estate->update([
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
        } else {
            return response()->json(['message' => 'Estate Not Found']);
        }
        return response()->json(['message' => 'Location Updated successfully']);
    }

    public function estateDescription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:10000',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $description = $request->input('description');
        $landlord_id = $request->input('landlord_id');
        $estate_id = $request->input('estate_id');
        
        $estate = Estate::where('landlord_id', $landlord_id)->where('uid', $estate_id)->first();
        if ($estate)
        {
            $estate->update([
                'description' => $description,
            ]);
            return redirect()->route('estate.index')->with('success', 'Estate Description Updated successfully');
        } else {
            return redirect()->route('estate.index')->with('error', 'Estate Not found');
        }
    }

}

