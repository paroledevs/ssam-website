<?php

namespace App\Http\Controllers\Dashboard;

use App\Asteroide\Traits\DealWithFiles;
use App\Asteroide\Traits\MapPolymorphicModels;
use App\Asteroide\Traits\Notifications;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use DealWithFiles,
        Notifications,
        MapPolymorphicModels;

    public function __construct()
    {
        $this->registerPolymorphicClasses('post');

        $this->addNotifications([
            'store' => 'Gallery has been updated',
            'destroy' => 'Image deleted from gallery',
        ]);
    }

    public function imageableModel()
    {
        return $this->morphModel('post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->polymorphicMapFromRequest($request);

        return ImageResource::collection($this->imageableModel() ? $this->imageableModel()->images : Image::covers()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request)
    {
        $this->polymorphicMapFromRequest($request);

        if (filled($this->imageableModel())) {
            foreach ($request->images as $uploadedImage) {
                $this->imageableModel()->images()->save(new Image([
                    'path' => $this->saveFile($this->imageableModel()->storagePath('gallery'), $uploadedImage),
                ]));
            }
        } else {
            foreach ($request->images as $uploadedImage) {
                Image::create([
                    'path' => $this->saveFile('home', $uploadedImage),
                    'is_cover' => true,
                ]);
            }
        }

        return response()->json($this->getApiNotification());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $this->deleteFile($image->path);

        $image->delete();

        return response()->json($this->getApiNotification());
    }
}
