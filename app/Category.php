<?php

namespace App;

use App\Traits\HasNested;
use App\Traits\HasVisibleFlag;
use Yasaie\Dictionary\Traits\HasDictionary;

/**
 * Class    Category
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-04
 *
 * @package App
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $parent_id
 * @property string $path
 *
 * @property-read Product $products
 *
 * @property-read string $title
 *
 */
class Category extends BaseModel
{
    use HasDictionary,
        HasNested,
        HasVisibleFlag;

    protected $locales = ['title'];

    protected $fillable = ['parent_id', 'is_visible'];

    protected static function boot()
    {
        parent::boot();

        static::created(function (Category $table) {
            $table->save();
        });

        static::updating(function (Category $table)
        {
            $path = $table->parent
                ? explode('/', $table->parent->path)
                : [];
            $path[] = $table->id;
            $table->path = implode('/', $path);
        });

        static::bootVisibleFlag();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
