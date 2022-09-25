<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class GetOrderList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            "id" =>  $this->id,
            "invoice" =>  $this->transaction_id,
            "date" =>  date_format( $this->created_at, 'd F Y à h:m:s'),
            "status" => $this->paymentStatus,
            "name"=> $this->products->pluck('name')->first() != null ? $this->products->pluck('name')->first() : 'Aucun Produit sur cette commande',
            "image"=> $this->products->pluck('image')->first() != null ? 'https://kalisso.com/storage/'.$this->products->pluck('image')->first() : 'https://kalisso.com/storage/users/default.png',
            "count"=> count($this->products) <= 1 ? 0 : count($this->products)-1,
            "payment"=> $this->billing_total,
        ];
    }
}
