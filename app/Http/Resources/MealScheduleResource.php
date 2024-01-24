<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\MealResource;
use Illuminate\Http\Resources\Json\JsonResource;
class MealScheduleResource extends JsonResource
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
            'meals' => MealResource::collection($this->meals),
            'users' => UserResource::collection($this->users),
            'meal_time' => $this->meal_time,
            'start' => $this->start_date,
            'end' => $this->end_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
      