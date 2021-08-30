<?php

namespace Database\Seeders;

use App\Models\Settings\Status;
use Illuminate\Database\Seeder;

class FactoryStatusSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        Status::factory()->count(5)->create();
    }
}
