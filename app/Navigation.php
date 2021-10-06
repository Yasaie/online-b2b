<?php

namespace App;

use App\Traits\HasNested;
use Illuminate\Database\Eloquent\Builder;
use Yasaie\Dictionary\Traits\HasDictionary;

/**
 * Class    Navigation
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
 * @property int $parent_id
 * @property string $link
 *
 * @property-read string $title
 *
 */
class Navigation extends BaseModel
{
    use HasDictionary,
        HasNested;

    protected $locales = ['title'];
}
