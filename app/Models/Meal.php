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

    protected $fillable = ['cook_id', 'name', 'region', 'description',  'price', 'ingredients', 'cooking_limit', 'status'];

    protected $casts = [
        'ingredients' => 'json',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cook_id', 'id');
    }
    public function meal_schedule(): HasMany
    {
        return $this->hasMany(MealSchedule::class);
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
