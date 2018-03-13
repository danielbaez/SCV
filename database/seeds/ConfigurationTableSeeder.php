<?php

use Illuminate\Database\Seeder;
use App\Configuration;

class ConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
        	'company' => 'Mi empresa',
        	'document' => '78676567876',
        	'address' => 'San isidro labrador ,ded efe',
        	'phone' => '5273263',
            'tax' => 'IGV',
            'tax_percentage' => '18',
            'currency' => 'S/ ',
        	'representative' => 'Daniel Baez'
        ]);
    }
}
