<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use Illuminate\Support\Str;

class ResourceController extends Controller
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
    public function store(StoreResourceRequest $request)
    {
        $resource = new Resource();
        $resource->setConnection('mysql_estates');
        $resource->resource = $request->resource;
        $resource->slug = Str::slug($request->resource);
        $resource->save();
        return redirect()->route('duration.index')->with('success', 'New Resource Type Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResourceRequest $request, Resource $resource)
    {
        $resource->update($request->validated());
        $resource->resource = $request->input('resource');
        $resource->slug = Str::slug($request->input('resource'));
        return redirect()->route('duration.index')->with('success', 'The Resource Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        //
    }

    public function changeResourceStatus($slug)
    {
        $resource = Resource::where('slug', $slug)->first();

        if ($resource) {
            if ($resource->status == 1) {
                $resource->where('slug', $slug)->update(['status' => 0]);
            } else {
                $resource->where('slug', $slug)->update(['status' => 1]);
            }
            
            return redirect()->route('duration.index')->with('success', 'Resource Status Changed successfully');
        } else {
            return redirect()->route('duration.index')->with('error', 'Resource Not found');
        }
    }
}
