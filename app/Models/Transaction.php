<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\discount_code;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function cart(): hasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function discountCode(): BelongsTo
    {
        return $this->belongsTo(discount_code::class);
    }
}
