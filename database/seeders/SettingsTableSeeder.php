<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'key' => 'FREE_SHIPPING',
                'values' => [
                    'min_amount' => 499,
                    'is_active' => 0,
                ],
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        $this->command->warn('Opciones de configuración creadas');
    }
}
