<?php

use Illuminate\Database\Seeder;
use App\Branch;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
        	'name' => 'Sucursal San Vicente',
        	'document_type' => 'RUC',
        	'document' => '73826737823',
        	'address' => 'San Vicente',
        	'phone' => '5653846',
        	'state' => 1
        ]);

        Branch::create([
        	'name' => 'Sucursal Imperial',
        	'document_type' => 'RUC',
        	'document' => '73822312342',
        	'address' => 'Imperial',
        	'phone' => '3333846',
        	'state' => 1
        ]);
    }
}
