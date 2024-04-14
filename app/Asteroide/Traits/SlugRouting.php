<?php

namespace App\Asteroide\Traits;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Request;

trait SlugRouting
{
    use Sluggable;

    public $patterWebPrefix = 'admin/*';

    public $patterApiPrefix = 'api/*';

    public $defaultSlugSource = 'title';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => $this->slugSource ?? $this->defaultSlugSource,
            ],
        ];
    }

    /**
     * Configurable definitions always public
     * [$adminWebPrefix, $adminApiPrefix]
     *
     * @return void
     */
    public function resolveRouteKey()
    {
        return Request::is($this->adminWebPrefix ?? $this->patterWebPrefix) || Request::is($this->adminApiPrefix ?? $this->patterApiPrefix) ? 'id' : 'slug';
    }

    /**
     * Configurable definitions always public
     * [$useSlugRouting]
     *
     * @return void
     */
    public function getRouteKeyName()
    {
        return ($this->useSlugRouting ?? true) ? $this->resolveRouteKey() : 'id';
    }
}
