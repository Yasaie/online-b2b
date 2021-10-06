<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class    CoRequest
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-27
 *
 * @package App\Http\Resources
 * @mixin \App\CoRequest
 */
class CoRequest extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product' => new Product($this->whenLoaded('product')),
            'user' => new User($this->whenLoaded('user')),
            'description' => $this->description,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
