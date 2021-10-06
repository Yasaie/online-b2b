<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class    Setting
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-10
 *
 * @package App\Http\Resources
 * @mixin \App\Setting
 */
class Setting extends JsonResource
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
            'key' => $this->key,
            'value' => $this->content ?: $this->locale
        ];
    }
}
