<?php

namespace App\Http\Resources\Product;

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
            'name' => $this->name,
            'category' => $this->category_id,
            'brand' => $this->brand_id,
            'price' => $this->price,
            'stock' => $this->stock == 0 ? 'Out of stock' : $this->stock,
            'unit' => $this->unit,
            'discount' => $this->discount,
            'totalPrice' => round( (1 - ($this->discount/100)) * $this->price, 2),
            'rating' => $this->reviews->count() > 0 ? round( $this->reviews->sum('star')/$this->reviews->count(), 2) : 'Not Rating Yet',
            'description' => $this->detail,
            'href' => [
                'reviews' => route('reviews.index', $this->id)
            ],
        ];
    }
}
