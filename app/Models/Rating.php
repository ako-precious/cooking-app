<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = ['meal_id', 'user_id', 'presentation', 'taste', 'value', 'nutrition', 'portion_size','freshness', 'comment'];
}
