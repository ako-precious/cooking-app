<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class MealPhotos extends Model
{
    use HasFactory;
    protected $table = 'meal_photos';

    protected $fillable = ['meal_id', 'meal_photo_path', 'order'];

    public function meal(): BelongsTo
    {
        return $this->belongsTo(Meal::class, 'meal_id', 'id');
    }
}
