<?php

namespace App\Http\Controllers\Dashboard;

use App\Asteroide\Facades\Monitor;
use App\Asteroide\Traits\Notifications;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    use Notifications;

    public function settingsArray()
    {
        return [
            'shippingSetting' => Setting::shipping()->first(),
        ];
    }

    public function index()
    {
        return view('admin.settings.items', $this->settingsArray());
    }

    public function shipping(Setting $shippingSetting)
    {
        return view('admin.settings.shipping', $this->settingsArray());
    }

    public function update(Request $request, Setting $setting)
    {
        if ($request->filled('values')) {
            $setting->values = $request->values;

            Monitor::model($setting)
                ->audit(fn ($setting) => $setting->save())
                ->addDescription('Setings updated');
        }

        $this->prepareNotification($request);

        return back();
    }
}
