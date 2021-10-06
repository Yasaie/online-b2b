<?php

namespace App\Traits;

/**
 * Trait HasNested
 *
 * @package App
 * @mixin \Eloquent
 */
trait HasNested
{
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
