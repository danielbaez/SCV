<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
        	'name' => 'Público',
        	'lastname' => 'General',
        	'document' => '00000000',
        	'address' => 'av bolognesi',
        	'phone' => '3433232',
            'state' => 1
        ]);
    }
}
