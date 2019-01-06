<?php

namespace App\Http\Resources\Order;

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
            'product id' => $this->product_id,
            'quantity' => $this->quantity,
            'profile id' => $this->profile_id,
            'status' => $this->status,
        ];
    }
}
