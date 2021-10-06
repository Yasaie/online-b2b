<?php

namespace App;

/**
 * Class    CoRequest
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-27
 *
 * @package App
 * @mixin \Eloquent
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $product_id
 * @property int $user_id
 * @property string $description
 *
 * @property-read Product $product
 * @property-read User $user
 */
class CoRequest extends BaseModel
{

    protected $fillable = ['description', 'product_id', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $table) {
            $table->user_id = $table->user_id ?: \Auth::id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
