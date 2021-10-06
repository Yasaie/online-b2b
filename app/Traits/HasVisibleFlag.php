<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasVisibleFlag
 *
 * @package App\Traits
 * @mixin \Eloquent
 */
trait HasVisibleFlag
{

    public static function bootVisibleFlag()
    {
        static::addGlobalScope('visible', function (Builder $builder) {
            $builder->where('is_visible', 1);
        });
    }

    public static function withInvisible()
    {
        return self::withoutGlobalScope('visible');
    }
}
