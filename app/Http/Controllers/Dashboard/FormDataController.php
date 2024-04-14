<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionResource;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Setting;
use App\Models\ShippingOption;

class FormDataController extends Controller
{
    public function collections()
    {
        return CollectionResource::collection(Collection::all());
    }

    public function productLink(Product $product)
    {
        return response()->json([
            'url' => $product->link,
        ]);
    }

    public function shippingOptions()
    {
        return response()->json(ShippingOption::whereIsActive(true)->get());
    }

    public function sendFreeShippingCondition()
    {
        return response()->json(optional(Setting::shipping()->first())->values);
    }
}
