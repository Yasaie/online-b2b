<?php

namespace App;

use App\Traits\HasVisibleFlag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Yasaie\Dictionary\Traits\HasDictionary;

/**
 * Class    Product
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
 * @property int $created_by
 * @property int $updated_by
 * @property boolean $is_special
 * @property int $place_id
 *
 * @property-read Category $category
 * @property-read User $createdBy
 * @property-read User $updatedBy
 *
 * @property-read string $title
 * @property-read string $description
 */
class Product extends BaseModel implements HasMedia
{
    use HasDictionary,
        HasMediaTrait,
        HasVisibleFlag;

    protected $locales = ['title', 'description'];

    protected $fillable = ['category_id', 'place_id', 'is_visible', 'is_special'];

    public static function boot()
    {
        parent::boot();

        // create a event to happen on updating
        static::updating(function($table)  {
            $table->updated_by = $table->updated_by ?: \Auth::id();
        });

        // create a event to happen on saving
        static::saving(function($table)  {
            $table->created_by = $table->created_by ?: \Auth::id();
            $table->updated_by = $table->created_by ?: \Auth::id();
        });

        static::bootVisibleFlag();
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('image')
            ->acceptsFile(function (File $file) {
                $acceptable = [
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                ];
                return in_array($file->mimeType, $acceptable);
            });
    }

    /**
     * @author  Payam Yasaie <payam@yasaie.ir>
     * @since   2019-11-04
     *
     * @param Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->quality(75)
            ->format('jpg')
            ->fit(Manipulations::FIT_MAX, 250, 250);
    }

    public function getGallery()
    {
        return $this->getMedia('image')
            ->map(function (Media $img) {
                return [
                    'original' => $img->getFullUrl(),
                    'thumb' => $img->getFullUrl('thumb')
                ];
            });
    }

    public function firstThumb()
    {
        $media = $this->getFirstMedia('image');
        return $media
            ? $media->getFullUrl('thumb')
            : null;
    }

}
