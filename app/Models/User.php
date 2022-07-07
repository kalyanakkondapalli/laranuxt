<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'years_of_experience', 'contact', 'qualification', 'avatar', 'skills', 'about_me',
        'nature',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'skills'   => 'array'
    ];

    public function getAvatarAttribute($value)
    {
        return $value ? Storage::disk('public')->url($value) : '';
    }

    public function company(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
