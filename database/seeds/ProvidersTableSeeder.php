<?php

use Illuminate\Database\Seeder;
use App\Provider;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::create([
        	'business_name' => 'services s.a.c',
        	'name' => 'juan',
        	'lastname' => 'perez',
        	'document' => '32323232323',
        	'address' => 'av bolognesi',
        	'phone' => '3433232',
            'state' => 1
        ]);
    }
}
