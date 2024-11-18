<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resourses extends Model
{
    use HasFactory;

    protected $table = 'resources';

    protected $fillable = ['cook_id', 'name', 'region', 'description',  'price', 'ingredients', 'cooking_limit', 'status', 'ordering_preferences'];
}
