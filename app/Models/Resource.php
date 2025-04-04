<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $table = 'resources';

    protected $fillable = ['title', 'author', 'content', 'category',  'post_photo_path', 'read_time', 'slug', 'useful', 'useless'];
}
