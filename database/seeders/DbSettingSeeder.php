<?php

namespace Database\Seeders;

use App\Models\Settings\Setting;
use Illuminate\Database\Seeder;

class DbSettingSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        $data = [
            [
                'name' => Setting::$names['app_name'],
                'type' => Setting::$types['text'],
                'value' => config('app.name')
            ],
            [
                'name' => Setting::$names['logo'],
                'type' => Setting::$types['file'],
                'value' => ''
            ]
        ];

        Setting::insert($data);
    }
}
