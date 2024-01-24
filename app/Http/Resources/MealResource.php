<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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
            'cook_id' => $this->cook_id,
            'title' => $this->name,
            'description' => $this->description,            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}