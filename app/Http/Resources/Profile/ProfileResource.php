<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'customer name' => $this->customer_name,
            'customer contact number' => $this->customer_contact,
            'street' => $this->street,
            'city' => $this->city,
            'district' => $this->district,
            'zipcode' => $this->zipcode,
            'landmark' => $this->landmark,
            'address type' => $this->address_type,
        ];
    }
}
