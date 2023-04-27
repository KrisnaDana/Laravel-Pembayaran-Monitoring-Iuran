<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id', 'remember_token', 'created_at', 'updated_at'];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pembayarans(): HasMany {
        return $this->hasMany(Pembayaran::class);
    }

    public function diskusis(): HasMany {
        return $this->hasMany(Diskusis::class);
    }
}
