<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class discount_code extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function transactions(): HasMany
    {
        // return $this->hasMany(Transaction::class, 'discount_code_id');
        return $this->hasMany(Transaction::class);
    }

    public function transaction(): HasMany
    {
        // return $this->hasMany(Transaction::class, 'discount_code_id');
        return $this->hasMany(Transaction::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('id', 'LIKE', '%' . $search . '%')
                    ->orWhere('code', 'LIKE', '%' . $search . '%')
                    ->orWhere('min_price', 'LIKE', '%' . $search . '%')
                    ->orWhere('offer', 'LIKE', '%' . $search . '%')
                    ->orWhere('max_offer', 'LIKE', '%' . $search . '%')
                    ->orWhere('type', 'LIKE', '%' . $search . '%')
                    ->orWhere('start_date', 'LIKE', '%' . $search . '%')
                    ->orWhere('expire_date', 'LIKE', '%' . $search . '%')
                    ->orWhere('created_at', 'LIKE', '%' . $search . '%');
            });
        }
    }

    // public function transaction(): BelongsTo
    // {
    //     return $this->belongsTo(Transaction::class);
    // }
}
