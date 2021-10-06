<?php

use Illuminate\Database\Seeder;
use Yasaie\Dictionary\Dictionary;

class DictionariesTableSeeder extends Seeder
{
    protected function create($model, $values)
    {
        foreach ($values as $key => $items) {
            foreach ($items as $lang => $value) {
                Dictionary::create([
                    'language_id' => $lang,
                    'context_type' => get_class($model),
                    'context_id' => $model->id,
                    'key' => $key,
                    'value' => $value
                ]);
            }
        }
    }
}
