<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $table = 'meals';

    protected $fillable = ['cook_id', 'name', 'region', 'description',  'price', 'ingredients', 'cooking_limit', 'status', 'ordering_preferences'];

    protected $casts = [
        'ingredients' => 'json',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cook_id', 'id');
    }
    public function cook(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cook_id', 'id');
    }

    public function meal_schedule(): HasMany
    {
        return $this->hasMany(MealSchedule::class);
    }
    public function mealPhotos(): HasMany
    {
        return $this->hasMany(MealPhotos::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            if (is_null($model->status)) {
                $model->status = 'pending';
            }
        });
        
    }
}
