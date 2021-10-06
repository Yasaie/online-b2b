<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yasaie\Dictionary\Traits\HasDictionary;

/**
 * Class    Setting
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-10
 *
 * @package App
 * @mixin \Eloquent
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $key
 * @property string $content
 *
 * @property-read string $locale
 * @property-write string $value
 *
 */
class Setting extends Model
{
    use HasDictionary;

    protected $guarded = [];

    protected $locales = ['locale'];

    public function setValueAttribute()
    {
        dd('he');
    }
}
