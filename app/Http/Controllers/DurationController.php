<?php

namespace App\Http\Controllers;

use App\Models\Duration;
use App\Http\Requests\StoreDurationRequest;
use App\Http\Requests\UpdateDurationRequest;
use Illuminate\Support\Str;
use App\Models\Resource;

class DurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $durations = Duration::on('mysql_estates')->get();
        $resources = Resource::on('mysql_estates')->get();
        return view('durations.index', compact(
            'durations',
            'resources',
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
    public function store(StoreDurationRequest $request)
    {
        $duration = new Duration();
        $duration->setConnection('mysql_estates');
        $duration->duration = $request->duration;
        $duration->slug = Str::slug($request->duration);
        $duration->save();
        return redirect()->route('duration.index')->with('success', 'New Duration Type Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Duration $duration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Duration $duration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDurationRequest $request, Duration $duration)
    {
        $duration->update($request->validated());
        $duration->duration = $request->input('duration');
        $duration->slug = Str::slug($request->input('duration'));
        return redirect()->route('duration.index')->with('success', 'The Duration Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Duration $duration)
    {
        //
    }

    public function changeDurationStatus($slug)
    {
        $duration = Duration::where('slug', $slug)->first();

        if ($duration) {
            if ($duration->status == 1) {
                $duration->where('slug', $slug)->update(['status' => 0]);
            } else {
                $duration->where('slug', $slug)->update(['status' => 1]);
            }
            
            return redirect()->route('duration.index')->with('success', 'Duration Status Changed successfully');
        } else {
            return redirect()->route('duration.index')->with('error', 'Duration Not found');
        }
    }
}
