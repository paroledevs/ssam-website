<?php

namespace App\Asteroide\Support;

use Illuminate\Support\Facades\Http;

class Localization
{
    public static function getUserTimeZone()
    {
        $response = Http::get('http://ip-api.com/json/'.(app()->environment(['local']) ? '' : request()->ip()));

        if ($response->ok()) {
            $data = $response->json();

            if (isset($data['timezone'])) {
                return $data['timezone'];
            }
        }

        return null;
    }

    public static function userInMexico()
    {
        $response = Http::get('http://ip-api.com/json/'.(app()->environment(['local']) ? '' : request()->ip()));

        if (app()->runningInConsole() && app()->environment(['local', 'development']) && $response->ok()) {
            dump($response->json());
        }

        if ($response->ok()) {
            $data = $response->json();

            if (strtoupper($data['countryCode'] ?? '') === 'MX') {
                return true;
            }
        }

        return false;
    }
}
