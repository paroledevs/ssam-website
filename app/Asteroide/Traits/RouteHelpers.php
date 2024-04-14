<?php

namespace App\Asteroide\Traits;

trait RouteHelpers
{
    public function getRoutesFor($resource, $params = [], $options = [])
    {
        $routes = [];
        $names = ['index', 'show', 'store', 'update', 'destroy', 'site'];

        $parentParams = $options['parentParams'] ?? [];
        $siteParams = $options['siteParams'] ?? [];

        $names = $options['only'] ?? $names;

        foreach ($options['except'] ?? [] as $name) {
            unset($names[array_search($name, $names) ?? 'none']);
        }

        foreach ($names as $name) {
            switch ($name) {
                case 'index':
                case 'store':
                    $routes[$name] = route("$resource.$name", $parentParams);
                    break;

                case 'site':
                    $routes[$name] = route('site.'.array_key_first($params), $parentParams + $siteParams);
                    break;

                default:
                    $routes[$name] = route("$resource.$name", $parentParams + $params);
                    break;
            }
        }

        return $routes;
    }
}
