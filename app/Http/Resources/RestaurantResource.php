<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RestaurantResource extends Resource
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
            'city_id' => $this->city_id,
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'avatar' => $this->avatar,
            'address' => $this->address,
            'tel' => $this->tel,
            'images' => $this->images,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
