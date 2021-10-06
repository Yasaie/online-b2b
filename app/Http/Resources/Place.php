<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class    Place
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-09
 *
 * @package App\Http\Resources
 * @mixin \App\Place
 */
class Place extends JsonResource
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
        $path = array_map('intval', explode('/', $this->path));

        return [
            'id' => $this->id,
            'parent' => new self($this->whenLoaded('parent')),
            'children' => self::collection($this->whenLoaded('children')),
            'path' => $this->whenLoaded('parent', function () use ($path) {
                return self::collection(\App\Place::whereIn('id', $path)->get());
            }),
            'type' => $this->type,
            'name' => $this->name,
            'is_visible' => $this->is_visible,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
