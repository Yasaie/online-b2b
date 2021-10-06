<?php

use App\Setting;

class SettingsTableSeeder extends DictionariesTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obj[1] = Setting::create([
            'key' => 'footer.1.title',
        ]);
        $obj[2] = Setting::create([
            'key' => 'footer.1.body',
        ]);

        $obj[3] = Setting::create([
            'key' => 'footer.2.title',
        ]);
        $obj[4] = Setting::create([
            'key' => 'footer.2.body',
        ]);

        $obj[5] = Setting::create([
            'key' => 'footer.3.title',
        ]);
        $obj[6] = Setting::create([
            'key' => 'footer.3.body',
        ]);

        $obj[7] = Setting::create([
            'key' => 'footer.4.title',
        ]);
        $obj[8] = Setting::create([
            'key' => 'footer.4.body',
        ]);

        # Dictionary
        $this->create($obj[1], [
            'locale' => [
                'fa' => 'عنوان بلاک 1',
                'en' => 'Block 1',
            ]
        ]);
        $this->create($obj[2], [
            'locale' => [
                'fa' => 'متن بلاک 1',
                'en' => 'Body of Block 1',
            ]
        ]);

        $this->create($obj[3], [
            'locale' => [
                'fa' => 'عنوان بلاک 2',
                'en' => 'Block 2',
            ]
        ]);
        $this->create($obj[4], [
            'locale' => [
                'fa' => 'متن بلاک 2',
                'en' => 'Body of Block 2',
            ]
        ]);

        $this->create($obj[5], [
            'locale' => [
                'fa' => 'عنوان بلاک 3',
                'en' => 'Block 3',
            ]
        ]);
        $this->create($obj[6], [
            'locale' => [
                'fa' => 'متن بلاک 3',
                'en' => 'Body of Block 3',
            ]
        ]);

        $this->create($obj[7], [
            'locale' => [
                'fa' => 'عنوان بلاک 4',
                'en' => 'Block 4',
            ]
        ]);
        $this->create($obj[8], [
            'locale' => [
                'fa' => 'متن بلاک 4',
                'en' => 'Body of Block 4',
            ]
        ]);
    }
}
