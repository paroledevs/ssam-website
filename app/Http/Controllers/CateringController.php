<?php

namespace App\Http\Controllers;

use App\Asteroide\Traits\Notifications;
use App\Models\Catering;
use Illuminate\Http\Request;

class CateringController extends Controller
{
    use Notifications;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $caterings = Catering::all();

        return view('admin.website.catering', compact('caterings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Catering::create($request->all());

        $this->prepareNotification($request);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catering  $catering
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catering $catering)
    {
        $catering->delete();

        $this->prepareNotification(request());

        return back();
    }
}
