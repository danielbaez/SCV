<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Danel',
        	'lastname' => 'Baez',
        	'document' => 72211160,
        	'birth_date' => '1993-01-08',
        	'address' => 'San Isidro',
        	'email' => 'daniel_bg19@hotmail.com',
            'password' => bcrypt('123456'),
            'phone' => '96430382',
        	'rol_id' => 1,
        	'branch_id' => 1,
            'state' => 1
        ]);

        User::create([
            'name' => 'aaa',
            'lastname' => 'Baez',
            'document' => 722260,
            'birth_date' => '1993-01-08',
            'address' => 'San Isidro',
            'email' => 'ddwdwdwaniel_bg19@hotmail.com',
            'password' => bcrypt('123456'),
            'phone' => '968842',
            'rol_id' => 1,
            'branch_id' => 1,
            'state' => 1
        ]);

        User::create([
            'name' => 'eeeeee',
            'lastname' => 'Baez',
            'document' => 7223360,
            'birth_date' => '1993-01-08',
            'address' => 'San Isidro',
            'email' => 'ddwdwaniel_bg19@hotmail.com',
            'password' => bcrypt('123456'),
            'phone' => '912382',
            'rol_id' => 1,
            'branch_id' => 1,
            'state' => 1
        ]);

        User::create([
            'name' => 'dwdewewwDanel',
            'lastname' => 'Baez',
            'document' => 7244560,
            'birth_date' => '1993-01-08',
            'address' => 'San Isidro',
            'email' => 'ddwdweweaniel_bg19@hotmail.com',
            'password' => bcrypt('123456'),
            'phone' => '964382',
            'rol_id' => 1,
            'branch_id' => 1,
            'state' => 1
        ]);

        User::create([
            'name' => 'dwdwDanewewel',
            'lastname' => 'Baez',
            'document' => 72236660,
            'birth_date' => '1993-01-08',
            'address' => 'San Isidro',
            'email' => 'ddwdewewwaniel_bg19@hotmail.com',
            'password' => bcrypt('123456'),
            'phone' => '9632382',
            'rol_id' => 1,
            'branch_id' => 1,
            'state' => 1
        ]);

        User::create([
            'name' => 'dwdwDaqqqnel',
            'lastname' => 'Baez',
            'document' => 7277860,
            'birth_date' => '1993-01-08',
            'address' => 'San Isidro',
            'email' => 'ddwdwaddniel_bg19@hotmail.com',
            'password' => bcrypt('123456'),
            'phone' => '9682',
            'rol_id' => 1,
            'branch_id' => 1,
            'state' => 1
        ]);
    }
}
