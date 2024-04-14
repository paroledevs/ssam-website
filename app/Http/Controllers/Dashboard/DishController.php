<?php

namespace App\Http\Controllers\Dashboard;

use App\Asteroide\Traits\ControllerHelpers;
use App\Asteroide\Traits\DealWithFiles;
use App\Asteroide\Traits\MapPolymorphicModels;
use App\Asteroide\Traits\Notifications;
use App\Http\Controllers\Controller;
use App\Http\Requests\DishRequest;
use App\Models\Category;
use App\Models\Dish;

class DishController extends Controller
{
    use ControllerHelpers,
        Notifications,
        MapPolymorphicModels,
        DealWithFiles;

    public function __construct()
    {
        $this->registerPolymorphicClasses('category');
    }

    public function category()
    {
        return $this->morphModel('category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::orderBy('created_at', 'desc')->paginate($this->itemsPerPage);

        return view('admin.menu.items', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dishes = Dish::orderBy('created_at', 'desc')->paginate($this->itemsPerPage);
        $categories = Category::all();

        return view('admin.menu.create', compact('dishes', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DishRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishRequest $request)
    {
        $this->polymorphicMapFromRequest($request);

        $dish = new Dish($request->all() + [
            'cover_image_path' => $request->hasFile('cover') ? $this->saveFile('menu', $request->cover) : null,
        ]);

        $this->category()->dishes()->save($dish);

        $this->prepareNotification($request);

        return redirect()->route('menu.edit', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $dishes = Dish::orderBy('created_at', 'desc')->paginate($this->itemsPerPage);
        $categories = Category::all();

        return view('admin.menu.edit', compact('dishes', 'dish', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DishRequest  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(DishRequest $request, Dish $dish)
    {
        $this->polymorphicMapFromRequest($request);

        $dish->fill($request->all());

        if ($request->hasFile('cover')) {
            $this->deleteFile($dish->cover_image_path);

            $dish->cover_image_path = $this->saveFile('menu', $request->cover);
        }

        $this->category()->dishes()->save($dish);

        $this->prepareNotification($request);

        return redirect()->route('menu.edit', compact('dish'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $this->deleteFile($dish->cover_image_path);

        $dish->delete();

        $this->prepareNotification(request());

        return redirect()->route('menu.index');
    }
}
