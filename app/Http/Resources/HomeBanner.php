<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeBanner extends JsonResource
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
            'id' => $this->category_banner_id,
            'category_id' => $this->category_id,
            'name' => $this->category_banner_name,
            'image' => $this->category_banner_image
        ];
    }
}
