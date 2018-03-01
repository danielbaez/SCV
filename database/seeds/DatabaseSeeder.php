<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ConfigurationTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(VouchersTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        factory(App\User::class, 100)->create();

        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(PresentationsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
    }
}
