<?php

namespace App\Http\Controllers\Dashboard;

use App\Asteroide\Traits\ControllerHelpers;
use App\Asteroide\Traits\DealWithFiles;
use App\Asteroide\Traits\Notifications;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Models\Location;

class LocationController extends Controller
{
    use ControllerHelpers,
        DealWithFiles,
        Notifications;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::orderBy('created_at', 'desc')->paginate($this->itemsPerPage);

        return view('admin.locations.items', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::orderBy('created_at', 'desc')->paginate($this->itemsPerPage);

        return view('admin.locations.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $location = Location::create($request->all() + [
            'cover_image_path' => $request->hasFile('cover') ? $this->saveFile('locations', $request->cover) : null,
        ]);

        $this->prepareNotification($request);

        return redirect()->route('locations.edit', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        $locations = Location::orderBy('created_at', 'desc')->paginate($this->itemsPerPage);

        return view('admin.locations.edit', compact('locations', 'location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LocationRequest  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, Location $location)
    {
        $location->fill($request->all());

        if ($request->hasFile('cover')) {
            $this->deleteFile($location->cover_image_path);

            $location->cover_image_path = $this->saveFile('locations', $request->cover);
        }

        $location->save();

        $this->prepareNotification($request);

        return redirect()->route('locations.edit', compact('location'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $this->deleteFile($location->cover_image_path);

        $location->delete();

        $this->prepareNotification(request());

        return redirect()->route('locations.index');
    }
}
