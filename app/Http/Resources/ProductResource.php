<?php

namespace App\Http\Resources;

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
            'name' => $this->name,
            'cart_image' => $this->cart_image,
            'price' => $this->price,
            'new' => $this->new ? true : false,
            'category' => $this->category->name,
            'description' => $this->description,
            'features' => $this->features,
            'includes' => $this->whenLoaded('productInclude')->map(fn($item) => [
                'item' => $item->item,
                'quantity' => $item->quantity
            ]),
            'product_images' => $this->whenLoaded('productImages')->map(fn($item) => [
                'image_path' => $item->path,

            ]),
        ];
    }
}
