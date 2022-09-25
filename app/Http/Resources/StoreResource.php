<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            "id"      =>  $this->id,
            "name"    =>  $this->store_name,
            'slug'    =>  $this->slug,
            'description'   =>  $this->description,
            'location'   =>  $this->town,
            'address'   =>  $this->adress,
            'category'   =>  $this->type,
            'created_at'   =>  $this->created_at,
            'logo'   =>  json_decode($this->logo),
            'products' => $this->products
        ];
    }
}
