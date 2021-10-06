<?php

namespace App;

use App\Traits\HasNested;
use App\Traits\HasVisibleFlag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class    Place
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-04
 *
 * @package App
 * @mixin \Eloquent
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property string $name
 * @property string $type
 * @property double $latitude
 * @property double $longitude
 * @property int $parent_id
 *
 */
class Place extends BaseModel
{
    use HasNested,
        HasVisibleFlag;

    protected $fillable = [
        'parent_id',
        'type',
        'name'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function (self $table) {
            $table->save();
        });

        static::updating(function (self $table)
        {
            $path = $table->parent
                ? explode('/', $table->parent->path)
                : [];
            $path[] = $table->id;
            $table->path = implode('/', $path);
        });

        static::bootVisibleFlag();
    }
}
