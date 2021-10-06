<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * Class    Category
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-05
 *
 * @package App\Http\Resources
 * @mixin \App\Category
 */
class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        if ($this->resource) {
            $path = array_map('intval', explode('/', $this->path));
            return [
                'id' => $this->id,
                'title' => $request->locales ? $this->localArray('title') : $this->title,
                'is_visible' => $this->is_visible,
                'path' => $this->whenLoaded('parent', function () use ($path) {
                    return self::collection(\App\Category::withInvisible()->whereIn('id', $path)->get());
                }),
                'parent' => $this->whenLoaded('parent', function () {
                    return new self($this->parent()->withoutGlobalScope('visible')->first());
                }),
                'children' => self::collection($this->whenLoaded('children')),
                'created_at' => (string)$this->created_at,
                'updated_at' => (string)$this->updated_at,
            ];
        }

        return [];
    }
}
