<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchasedBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'book_name' => $this->name,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'author'=> new AuthorResource($this->whenLoaded('author'))
        ];

    }
}
