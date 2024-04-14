<?php

namespace App\Http\Controllers\Dashboard;

use App\Asteroide\Models\Activity;
use App\Asteroide\Traits\ControllerHelpers;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    use ControllerHelpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::orderBy('created_at', 'desc')->paginate($this->itemsPerPage);

        return view('admin.monitor.items', compact('activities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        $activities = Activity::orderBy('created_at', 'desc')->paginate($this->itemsPerPage);

        return view('admin.monitor.show', compact('activities', 'activity'));
    }
}
