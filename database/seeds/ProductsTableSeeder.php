<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
        	'category_id' => 1,
        	'brand_id' => 1,
        	'presentation_id' => 1,
        	'name' => 'AE3EFE',
        	'minimum_stock' => 3,
        	'stock' => 10,
        	'purchase_price' => '2000',
        	'sale_price' => '2500',
            'state' => 1
        ]);
    }
}
