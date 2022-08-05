<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAddress extends JsonResource
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
            "id"=> $this->address_id,
            "title" => $this->title,
            "recipientName" => $this->recipient_name,
            "phoneNumber" => $this->phone_number,
            "addressLine1" => $this->address_line1,
            "addressLine2" => $this->address_line2,
            "state" => $this->state,
            "postalCode" => $this->postal_code,
            "defaultAddress" => $this->default_address == 1 ? true : false,
        ];  
    }
}
