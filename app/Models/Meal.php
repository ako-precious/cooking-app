<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cook_id', 'id');
    }
    public function meal_schedule(): HasMany
    {
        return $this->hasMany(MealSchedule::class);
    }
}
