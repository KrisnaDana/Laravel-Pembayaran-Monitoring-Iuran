<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriodeBayar extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function periode(): BelongsTo {
        return $this->belongsTo(Periode::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
