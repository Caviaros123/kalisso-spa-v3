<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;

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
            "store" => [
                "id"      =>  (int) $this->id,
                "name"    =>  $this->store_name,
                "slug"    =>  $this->slug,
                "description"   =>  strip_tags($this->description),
                "location"   =>  $this->town,
                "email"   =>  $this->email,
                "address"   =>  $this->adress,
                "category"   =>  $this->type,
                "created_at"   =>  $this->created_at,
                "logo"   =>  json_decode($this->logo),
            ],
            "products" => ProductResource::collection($this->products)
        ];
    }
}
