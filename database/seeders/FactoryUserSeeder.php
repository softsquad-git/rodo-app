<?php

namespace Database\Seeders;

use App\Models\Users\User;
use Illuminate\Database\Seeder;

class FactoryUserSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        User::factory(1)->create();
    }
}
