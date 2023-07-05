<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Iuran extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function alokasis(): HasMany {
        return $this->hasMany(Alokasi::class);
    }

    public function periodes(): HasMany {
        return $this->hasMany(Periode::class);
    }

    public function Pembayaran(): HasMany {
        return $this->hasMany(Pembayaran::class);
    }
}
