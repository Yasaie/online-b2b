<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class    Product
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-05
 *
 * @package App\Http\Resources
 * @mixin \App\Product
 */
class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $full = $request->full !== "0" ? 1 : 0;

        if ($this->resource) {
            return [
                'id' => $this->id,
                'title' => $request->locales ? $this->localArray('title') : $this->title,
                $this->mergeWhen($full, [
                    'description' => $request->locales ? $this->localArray('description') : $this->description
                ]),
                'is_special' => $this->is_special,
                'is_visible' => $this->is_visible,
                'category' => $this->whenLoaded('category', function () use ($full) {
                    return collect(new Category($this->category->load('parent')))
                        ->only(['id', 'title', $full ? 'path' : '']);
                }),
                'place' => $this->whenLoaded('place', function () {
                    return (new Place($this->place));
                }),
                'created_by' => $this->when(\Auth::check(), function () {
                    return $this->createdBy->only(['id', 'first_name', 'last_name']);
                }),
                $this->mergeWhen($full, [
                    'gallery' => $this->getGallery(),
                ]),
                'thumb' => $this->firstThumb(),
                'created_at' => (string)$this->created_at,
                'updated_at' => (string)$this->updated_at,
            ];
        }

        return [];
    }
}
