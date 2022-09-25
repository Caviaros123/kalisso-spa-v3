<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "name"    =>  $this->name,
            'slug'    =>  $this->slug,
            'details'   =>  $this->details, 
            'description'   =>  $this->description, 
            'price' =>  $this->price, 
            'etat'  =>  $this->etat, 
            'old_price' =>  $this->old_price, 
            'category'  =>  $this->category, 
            'stock' =>  $this->stock, 
            'image' =>  loadImg($this->image), 
            'images'    =>  $this->images, 
            'email' =>  $this->email, 
            'featured'  =>  $this->featured, 
            'store_id'  =>  $this->store_id, 
            'location'  =>  $this->location, 
            'livraison' =>  $this->livraison, 
            'rating'    =>  $this->rating, 
            'review'    =>  $this->review,
        ];
    }
}
