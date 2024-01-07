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

    // public function scopeSearch($query, $search)
    // {
    //     if ($search) {
    //         $query->where(function ($query) use ($search) {
    //             $query->where('transactions.id', 'LIKE', '%' . $search . '%')
    //                 ->orWhere('carts.name', 'LIKE', '%' . $search . '%')
    //                 ->orWhereHas('cart.seat', function ($seatQuery) use ($search) {
    //                     $seatQuery->where('seat', 'LIKE', '%' . $search . '%');
    //                 })
    //                 ->orWhere('discount_codes.code', 'LIKE', '%' . $search . '%');
    //         });
    //     }
    // }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('transactions.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('transactions.status', 'LIKE', '%' . $search . '%')
                    ->orWhere('transactions.created_at', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('cart', function ($cartQuery) use ($search) {
                        $cartQuery->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('cart.seat', function ($seatQuery) use ($search) {
                        $seatQuery->where('seat', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('discountCode', function ($codeQuery) use ($search) {
                        $codeQuery->where('code', 'LIKE', '%' . $search . '%');
                    });
            });
        }
    }


    public function cart(): hasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function discountCode(): BelongsTo
    {
        // return $this->belongsTo(discount_code::class, 'id');
        return $this->belongsTo(discount_code::class, 'discount_code_id');
    }
}
