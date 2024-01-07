<?php

namespace App\Livewire\Admin;

use App\Models\Cart;
use App\Models\Seat;
use App\Models\User;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Facades\DB;

#[Lazy]
class Index extends Component
{
    public $usersCount, $seatsCount, $availableSeatsCount, $totalRevenue, $latestCheckout, $topBuyers, $latestUsers;
    public function mount()
    {
        $this->reset();
        $this->usersCount = User::count();
        $this->seatsCount = Seat::count();
        $this->availableSeatsCount = Seat::where('status', 'available')->count();
        $this->totalRevenue = Transaction::where('status', 'accepted')->where('payment_status', 'paid')->sum('total');
        $this->latestCheckout = Cart::join('transactions', 'carts.transaction_id', '=', 'transactions.id')
            ->join('seats', 'carts.seat_id', '=', 'seats.id')
            ->leftJoin('discount_codes', 'transactions.discount_code_id', '=', 'discount_codes.id')
            ->select('seats.seat', 'seats.class', 'carts.name', 'carts.price', 'discount_codes.code as discount_code', 'transactions.status')
            ->take(5)
            ->latest('transactions.created_at')
            ->get();
        $this->topBuyers = User::select('users.id', 'users.firstName', 'users.lastName', DB::raw('SUM(transactions.total) as totalPurchases'))
            ->join('carts', 'users.id', '=', 'carts.user_id')
            ->join('transactions', 'carts.transaction_id', '=', 'transactions.id')
            ->groupBy('users.id', 'users.firstName', 'users.lastName')
            ->orderByDesc('totalPurchases')
            ->take(3)
            ->get();
        $this->latestUsers = User::latest()->take(3)->get();
    }
    public function render()
    {
        return view('livewire.admin.index', [
            'usersCount' => $this->usersCount,
            'seatsCount' => $this->seatsCount,
            'availableSeatsCount' => $this->availableSeatsCount,
            'totalRevenue' => $this->totalRevenue,
            'latestCheckout' => $this->latestCheckout,
            'topBuyers' => $this->topBuyers,
            'latestUsers' => $this->latestUsers,
        ]);
    }
}
