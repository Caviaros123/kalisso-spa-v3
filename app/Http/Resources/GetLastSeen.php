<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetLastSeen extends JsonResource
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
            "id" => $this->product_id,
            "name" =>  $this->product_name,
            "price" =>  $this->product_price,
            "image" =>  $this->product_image,
            "rating" =>  $this->product_rating,
            "review" =>  $this->product_review,
            "sale" =>  $this->product_sale,
            "location" =>  $this->product_location,
        ];
    }
}
