<?php
/**
 * @package     shop
 * @author      Payam Yasaie <payam@yasaie.ir>
 * @copyright   2019-06-15
 */

use Carbon\Language;

return [
    'langs' => [
        'fa' => new Language('fa'),
        'en' => new Language('en'),
        'tr' => new Language('tr'),
    ],
    'place_types' => [
        'country', 'province', 'city'
    ]
];
