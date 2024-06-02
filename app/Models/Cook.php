<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cook extends Model
{
    use HasFactory;

    protected $table = 'cooks';

    protected $fillable = ['user_id', 'certificate', 'means_of_id', 'other_info', 'status'];

    protected $casts = [
        'status' => 'string', // Or 'enum:pending,available' depending on your setup
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
