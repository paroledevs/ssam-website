<?php

namespace App\Http\Controllers\Dashboard;

use App\Asteroide\Traits\ControllerHelpers;
use App\Asteroide\Traits\DealWithFiles;
use App\Asteroide\Traits\Notifications;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromoRequest;
use App\Models\Promo;

class PromoController extends Controller
{
    use Notifications,
        ControllerHelpers,
        DealWithFiles;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promos = Promo::paginate($this->itemsPerPage);

        return view('admin.promos.items', compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promos = Promo::paginate($this->itemsPerPage);

        return view('admin.promos.create', compact('promos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PromoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromoRequest $request)
    {
        $promo = Promo::create($request->all() + [
            'cover_image_path' => $request->hasFile('cover') ? $this->saveFile('promos', $request->cover) : null,
        ]);

        return redirect()->route('promos.edit', compact('promo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo)
    {
        $promos = Promo::paginate($this->itemsPerPage);

        return view('admin.promos.edit', compact('promos', 'promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PromoRequest  $request
     * @param  \App\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(PromoRequest $request, Promo $promo)
    {
        $promo->fill($request->all());

        if ($request->hasFile('cover')) {
            $this->deleteFile($promo->cover_image_path);

            $promo->cover_image_path = $this->saveFile('promos', $request->cover);
        }

        $promo->save();

        $this->prepareNotification($request);

        return redirect()->route('promos.edit', compact('promo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo)
    {
        $this->deleteFile($promo->cover_image_path);

        $promo->delete();

        $this->prepareNotification(request());

        return redirect()->route('promos.index');
    }
}
