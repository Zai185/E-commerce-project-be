<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'name' => $this->returnSubbed($this->name, 17),
            'slug' => $this->slug,
            'price' => $this->price,
            'description' => $this->description,
            'hasDiscount' => $this->hasDiscount,
            'discount' => $this->discount,
        ];
    }

    public function returnSubbed($name, $number)
    {
        if (strlen($name) < $number) return $name;
        return substr($name, 0, $number) . '...';
    }
}
