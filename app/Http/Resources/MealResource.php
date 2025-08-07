<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\CookResources;
class MealResource extends JsonResource
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
            'cook' => new UserResource($this->whenLoaded('user')), 
            'title' => $this->name,
            'prices' => $this->prices,
            'description' => $this->description,            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}