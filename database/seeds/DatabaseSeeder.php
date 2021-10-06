<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             UsersTableSeeder::class,
             PassportTableSeeder::class,
             PermissionTableSeeder::class,
             SettingsTableSeeder::class,

             CategoriesTableSeeder::class,
             PlacesTableSeeder::class,
             ProductsTableSeeder::class,
             NavigationsTableSeeder::class,
             CoRequestsTableSeeder::class

         ]);
    }
}
