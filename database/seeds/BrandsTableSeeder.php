<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
        	'name' => 'Lenovo',
            'state' => 1
        ]);
        Brand::create([
            'name' => 'HP',
            'state' => 1
        ]);
        Brand::create([
            'name' => 'Mac',
            'state' => 1
        ]);
        Brand::create([
            'name' => 'Toshiba',
            'state' => 1
        ]);
        Brand::create([
            'name' => 'Samsung',
            'state' => 1
        ]);
        Brand::create([
            'name' => 'Logitech',
            'state' => 1
        ]);
    }
}
