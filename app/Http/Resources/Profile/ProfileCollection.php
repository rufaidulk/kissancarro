<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\Resource;

class ProfileCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'customer name' => $this->customer_name,
            'customer contact number' => $this->customer_contact,
            'district' => $this->district,
            'address type' => $this->address_type,
        ];
    }
}
