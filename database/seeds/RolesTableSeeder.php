<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
        	'name' => 'Administrador',
            'state' => 1
        ]);
        Rol::create([
        	'name' => 'Registrador',
            'state' => 1
        ]);
        Rol::create([
        	'name' => 'Vendedor',
            'state' => 1
        ]);

    }
}
