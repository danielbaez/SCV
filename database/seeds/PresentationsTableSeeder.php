<?php

use Illuminate\Database\Seeder;
use App\Presentation;

class PresentationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Presentation::create([
        	'name' => 'Unidad',
            'state' => 1
        ]);
        Presentation::create([
            'name' => '1L',
            'state' => 1
        ]);
    }
}
