<?php

use App\Category;

class CategoriesTableSeeder extends DictionariesTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obj[1] = Category::create([]);
        $obj[2] = Category::create([]);
        $obj[3] = Category::create(['parent_id' => 2]);
        $obj[4] = Category::create(['parent_id' => 2]);

        # Dictionary
        $this->create($obj[1], [
            'title' => [
                'fa' => 'مصالح ساختمانی',
                'en' => 'Building Materials',
                'tr' => 'Yapı malzemeleri'
            ]
        ]);
        $this->create($obj[2], [
            'title' => [
                'fa' => 'مواد غذایی',
                'en' => 'Foodstuffs',
                'tr' => 'Gıda'
            ]
        ]);
        $this->create($obj[3], [
            'title' => [
                'fa' => 'تنقلات',
                'en' => 'Junk Food',
                'tr' => 'Atıştırmalıklar'
            ]
        ]);
        $this->create($obj[4], [
            'title' => [
                'fa' => 'میوه',
                'en' => 'Fruit',
                'tr' => 'Meyve'
            ]
        ]);
    }
}
