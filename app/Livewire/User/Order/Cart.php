<?php

namespace App\Livewire\User\Order;

use App\Models\Seat;
use App\Models\User;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\Cart as CartModel;
use App\Models\discount_code as DiscountCode;

class Cart extends Component
{
    public $carts;
    public $promoCode, $offer;
    public $subtotal, $total;

    public function mount()
    {
        $user = User::find(auth()->id());
        $this->reset();
        $this->carts = $user->cart()
            ->where(function ($query) {
                $query->where('transaction_id', null)
                    ->orWhereHas('transaction', function ($subquery) {
                        $subquery->where('payment_status', 'unpaid');
                    });
            })
            ->get();
        $this->subtotal = $user->cart()
            ->where(function ($query) {
                $query->where('transaction_id', null)
                    ->orWhereHas('transaction', function ($subquery) {
                        $subquery->where('payment_status', 'unpaid');
                    });
            })
            ->sum('price');
        $this->total = $this->subtotal;
    }

    public function applyPromo()
    {
        $this->total = $this->subtotal;
        $this->offer = 0;

        if ($promo = DiscountCode::where('code', $this->promoCode)->first()) {
            if (now() > $promo->expire_date || now() < $promo->start_date) {
                // session()->flash('promoError', 'Promo code expired!');
                session()->flash('promoError', 'Invalid promo code!');
                return;
            }
            if ($this->subtotal < $promo->min_price) {
                session()->flash('promoError', 'Your purchase must be at least ' . 'Rp. ' . number_format($promo->min_price, 0, ',', '.'));
                return;
            }

            switch ($promo->type) {
                case 'percentage':
                    $offer = $this->subtotal * ($promo->offer / 100);
                    if (isset($promo->max_offer) && $offer > $promo->max_offer) {
                        $this->total = $this->subtotal - $promo->max_offer;
                        $this->offer = $promo->max_offer;
                    } else {
                        $this->total = $this->subtotal - $offer;
                        $this->offer = $offer;
                    }
                    session()->flash('promoSuccess', 'Promo code applied successfully!');
                    break;

                case 'flat':
                    $this->total = $this->subtotal - $promo->offer;
                    $this->offer = $promo->offer;
                    session()->flash('promoSuccess', 'Promo code applied successfully!');
                    break;

                default:
                    session()->flash('promoError', 'Invalid promo code!');
                    # handle error for nonexistent promo type
                    break;
            }
        } else {
            session()->flash('promoError', 'Invalid promo code!');
        }

        return [
            'total' => $this->total,
            'offer' => $this->offer,
        ];
    }

    public function checkout()
    {
        if ($this->carts->isEmpty()) {
            $this->reset('error');
            session()->flash('bannerError', 'Your cart is currently empty. Find some seats before proceeding!');
            return;
        };

        if ($this->carts->pluck('seat.status')->contains('booked')) {
            session()->flash('bannerError', 'One or more seats in your cart are already booked! Please select another available seats.');
            return;
        };

        $discountCode = DiscountCode::where('code', $this->promoCode)->first();

        if ($this->carts->where('transaction_id', '!=', null)->isNotEmpty()) {
            $this->carts->each(function ($cart) {
                if ($cart->transaction->payment_status == 'paid') {
                    session()->flash('bannerError', 'One or more seats are already booked! Please select another available seats.');
                    return;
                };
            });
            $transaction = Transaction::where('id', $this->carts->first()->transaction_id)->first();
            $transaction->update([
                'discount_code_id' => $discountCode->id ?? null,
                'payment_status' => 'unpaid',
                'total' => $this->total,
            ]);
        } else {
            $transaction = Transaction::create([
                'discount_code_id' => $discountCode->id ?? null,
                'payment_status' => 'unpaid',
                'total' => $this->total,
            ]);
        };

        $this->carts->each(function ($cart) use ($transaction) {
            $cart->update([
                'transaction_id' => $transaction->id,
            ]);
        });

        session()->flash('transaction', [
            'tid' => $transaction->id,
            'carts' => $this->carts,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'promoCode' => $this->promoCode,
            'offer' => $this->offer,
        ]);
        return redirect()->route('checkout');
    }

    public function remove($id)
    {
        $item = CartModel::where('id', $id)->first();
        if ($item) {
            $item->delete();
            session()->flash('bannerSuccess', 'Seat ' . $item->seat->seat . ' removed successfully!');
            $this->mount();
        } else {
            session()->flash('bannerError', 'Item not found!');
        }

        return;
    }

    public function render()
    {
        $user = auth()->user();
        return view('livewire.user.order.cart', [
            'carts' => $this->carts,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'offer' => $this->offer,
        ])->title('Cart | ' . config('app.name'));
    }
}
