<?php

namespace App\Http\Controllers\Dashboard;

use App\Asteroide\Traits\RouteHelpers;
use App\Http\Controllers\Controller;

class SpaController extends Controller
{
    use RouteHelpers;

    public function products()
    {
        $siteRoute = [
            'site' => route('links.product', ['product' => 'ID']),
        ];

        $collectionRoute = [
            'collections' => route('data.collections'),
        ];

        $imagesRoutes = [
            'images' => $this->getRoutesFor('images', ['image' => 'ID'], [
                'parentParams' => [
                    'product' => 'PRODUCT_ID',
                ],
                'only' => [
                    'index',
                    'store',
                    'destroy',
                ],
            ]),
        ];

        $propGroupRoutes = [
            'propGroups' => [
                'groups' => $this->getRoutesFor('propGroup', ['propGroup' => 'ID'], [
                    'parentParams' => [
                        'product' => 'PRODUCT_ID',
                    ],
                    'only' => [
                        'index',
                        'store',
                        'update',
                        'destroy',
                    ],
                ]),
                'props' => $this->getRoutesFor('props', ['prop' => 'ID'], [
                    'parentParams' => [
                        'propGroup' => 'GROUP_ID',
                    ],
                    'only' => [
                        'store',
                        'update',
                        'destroy',
                    ],
                ]),
            ],
        ];

        $masiveRoutes = [
            'masive' => [
                'variants' => route('masive.variants', ['product' => 'PRODUCT_ID']),
                'props' => route('masive.props', ['product' => 'PRODUCT_ID']),
                'tags' => route('masive.tags', ['product' => 'PRODUCT_ID']),
            ],
        ];

        $variantsRoutes = [
            'variants' => $this->getRoutesFor('variants', ['variant' => 'ID'], [
                'parentParams' => ['product' => 'PRODUCT_ID'],
                'only' => [
                    'index',
                    'update',
                    'destroy',
                ],
            ]),
        ];

        $tagGroupRoutes = [
            'tagGroups' => [
                'groups' => $this->getRoutesFor('tagGroup', ['tagGroup' => 'ID'], [
                    'parentParams' => [
                        'product' => 'PRODUCT_ID',
                    ],
                    'only' => [
                        'index',
                        'store',
                        'update',
                        'destroy',
                    ],
                ]),
                'tags' => $this->getRoutesFor('tags', ['tag' => 'ID'], [
                    'parentParams' => [
                        'tagGroup' => 'GROUP_ID',
                    ],
                    'only' => [
                        'store',
                        'update',
                        'destroy',
                    ],
                ]),
            ],
        ];

        return view('admin.spa.products', [
            'routes' => $this->getRoutesFor('products', ['product' => 'ID'], ['except' => ['site']])
                + $siteRoute
                + $collectionRoute
                + $imagesRoutes
                + $masiveRoutes
                + $propGroupRoutes
                + $variantsRoutes
                + $tagGroupRoutes,
        ]);
    }
}
