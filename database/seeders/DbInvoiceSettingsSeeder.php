<?php

namespace Database\Seeders;

use App\Models\Invoices\InvoiceSetting;
use Illuminate\Database\Seeder;

class DbInvoiceSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'wfirma_login',
                'value' => ''
            ],
            [
                'name' => 'wfirma_pass',
                'value' => ''
            ]
        ];

        InvoiceSetting::insert($data);
    }
}
