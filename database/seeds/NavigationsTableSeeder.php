<?php

use App\Navigation;

class NavigationsTableSeeder extends DictionariesTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obj[1] = Navigation::create([
            'link' => '#'
        ]);
        $obj[2] = Navigation::create([
            'link' => '#',
            'parent_id' => 1
        ]);
        $obj[3] = Navigation::create([
            'link' => '#',
            'parent_id' => 1
        ]);
        $obj[4] = Navigation::create([
            'link' => '#',
        ]);
        $obj[5] = Navigation::create([
            'link' => '#',
        ]);

        $this->create($obj[1], [
            'title' => [
                'fa' => 'صفحات',
                'en' => 'Pages'
            ]
        ]);
        $this->create($obj[2], [
            'title' => [
                'fa' => 'تجارت و بازرگانی',
                'en' => 'Business'
            ]
        ]);
        $this->create($obj[3], [
            'title' => [
                'fa' => 'فرهنگ',
                'en' => 'Culture'
            ]
        ]);
        $this->create($obj[4], [
            'title' => [
                'fa' => 'درباره ما',
                'en' => 'About us'
            ]
        ]);
        $this->create($obj[5], [
            'title' => [
                'fa' => 'تماس با ما',
                'en' => 'Contact us'
            ]
        ]);
    }
}
