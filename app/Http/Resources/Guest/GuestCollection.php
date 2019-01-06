<?php

namespace App\Http\Resources\Guest;

use Illuminate\Http\Resources\Json\Resource;

class GuestCollection extends Resource
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
            'guest id' => $this->id,
            'guest IP' => $this->IP,
        ];
    }
}
