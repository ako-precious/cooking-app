<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class orders extends Model
{
    use HasFactory;
    
    protected $table = 'orders';
// meal_id represents the scheduled meal id 
    protected $fillable = ['meal_id', 'total_price', 'status', 'session_id'];

    public function mealSchedule(): HasOne
    {
        return $this->hasOne(MealSchedule::class);
    }
}
