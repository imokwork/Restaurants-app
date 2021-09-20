<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'user';

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'photo' => $this->photo,
            'information' => $this->information,
            'rating' => $this->rating,
            'lat' => $this->latitude,
            'lng' => $this->longitude,
            'position' => array(
                'lat' => (double) $this->latitude,
                'lng' => (double) $this->longitude,
            ),
        ];
    }
}
