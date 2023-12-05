<?php

namespace App\Http\Resources;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $item = $this->item;
        return [
            'id' => $this->id,
            'name' => $item->name,
            'price' => $item->price,
            'amount' => $this->amount,
            'image' => $item->image ? URL::to($item->image) : null,
            'item_id' => $item->id,
        ];
    }
}
