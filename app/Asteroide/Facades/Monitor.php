<?php

namespace App\Asteroide\Facades;

use Illuminate\Support\Facades\Facade;

class Monitor extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'monitor';
    }
}
