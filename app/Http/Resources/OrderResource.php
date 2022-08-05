<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "invoice" =>  $this->transaction_id,
            "date"    =>  $this->created_at,
            "status"  =>  $this->paymentStatus,
            "name"    =>  $this->name,
            "image"   =>  $this->image,
            "payment" =>  $this->billing_total
        ];
    }
}

