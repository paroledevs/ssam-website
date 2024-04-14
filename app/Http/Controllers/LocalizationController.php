<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function __construct()
    {
        $this->availableLangs = [
            'en',
            'es',
        ];
    }

    public function index($locale)
    {
        if (! in_array($locale, $this->availableLangs)) {
            abort(400);
        }

        App::setLocale($locale);

        Session::put('locale', $locale);

        return redirect()->back();
    }
}
