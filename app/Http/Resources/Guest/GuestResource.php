<?php

namespace App\Http\Resources\Guest;

use Illuminate\Http\Resources\Json\JsonResource;

class GuestResource extends JsonResource
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
            'guest id' => $this->id,
            'guest IP' => $this->IP,
        ];
    }
}
