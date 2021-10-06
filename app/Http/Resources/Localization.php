<?php

namespace App\Http\Resources;

use Carbon\Language;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class    Localization
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-07
 *
 * @package App\Http\Resources
 * @mixin Language
 */
class Localization extends JsonResource
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
            return [
                'id' => $this->getId(),
                'name' => $this->getFullIsoName(),
                'native' => $this->getNativeName(),
                'active' => app()->getLocale() == $this->getId(),
            ];
        }
        return [];
    }
}
