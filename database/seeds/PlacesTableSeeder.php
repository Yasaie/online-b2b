<?php

use App\Place;
use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Place::create([
            'type' => 'country',
            'name' => 'ایران',
        ]);

        Place::create([
            'type' => 'province',
            'name' => 'آذربایجان شرقی',
            'parent_id' => 1
        ]);
        Place::create([
            'type' => 'province',
            'name' => 'تهران',
            'parent_id' => 1
        ]);

        Place::create([
            'type' => 'city',
            'name' => 'تبریز',
            'parent_id' => 2
        ]);

        Place::create([
            'type' => 'city',
            'name' => 'تهران',
            'parent_id' => 3
        ]);
    }
}
