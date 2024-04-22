<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'title' => $this->title,
            'own_products' => $this->own_products,
            'image' => $this->image,
            'discount' => $this->discount,
            'popular' => $this->popular
        ];
    }
}
