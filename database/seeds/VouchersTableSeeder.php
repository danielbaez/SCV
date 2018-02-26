<?php

use Illuminate\Database\Seeder;
use App\Voucher;

class VouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voucher::create([
        	'name' => 'Boleta',
        	'serie' => '001',
        	'from' => '000001',
        	'to' => '999999',
            'state' => 1
        ]);
    }
}
