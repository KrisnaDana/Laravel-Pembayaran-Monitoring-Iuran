<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periode extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function iuran(): BelongsTo {
        return $this->belongsTo(Iuran::class);
    }

    public function periode_bayars(): HasMany {
        return $this->hasMany(PeriodeBayar::class);
    }
}
