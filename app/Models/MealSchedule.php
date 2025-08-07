<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class MealSchedule extends Model
{
    use HasFactory;

    protected $table = 'meal_schedules';

    protected $fillable = ['meal_id', 'user_id', 'meal_time', 'start_date', 'end_date', 'portion', 'address', 'prices'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'prices' => 'array', // Cast the JSON column to an array
    ];
    

    public function meal(): BelongsTo
    {
        return $this->belongsTo(Meal::class, 'meal_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function order(): HasOne
    {
        return $this->hasOne(Orders::class);
    }
}
