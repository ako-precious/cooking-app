<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;
use NotificationChannels\WebPush\HasPushSubscriptions;
class User extends Authenticatable implements MustVerifyEmail
{
    // use HasFactory, Notifiable, HasPushSubscriptions;
    use HasFactory, Notifiable;
    use HasFactory;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'dietary_restrictions_allergies',
        'continent',
        'other_info',
        'google_id',
        'facebook_id',
        'profile_photo_path',
        'email_verified_at'
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dietary_restrictions_allergies' => 'array'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function cook(): HasOne
    {
        return $this->hasOne(Cook::class);
    }
    public function meals():HasMany
    {
        return $this->hasMany(Meal::class, 'cook_id', 'id');
    }
    public function Chat():HasMany
    {
        return $this->hasMany(Chat::class);
    }
}
