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
        	'name' => 'Administrador'
        ]);
        Rol::create([
        	'name' => 'Registrador'
        ]);
        Rol::create([
        	'name' => 'Vendedor'
        ]);

    }
}
