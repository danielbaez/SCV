<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
        	'name' => 'Laptop',
            'state' => 1
        ]);
        Category::create([
            'name' => 'Impresora',
            'state' => 1
        ]);
        Category::create([
            'name' => 'Mouse',
            'state' => 1
        ]);
        Category::create([
            'name' => 'PC',
            'state' => 1
        ]);
    }
}
