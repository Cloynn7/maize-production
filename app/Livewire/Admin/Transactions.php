<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Facades\DB;

#[Lazy]
class Transactions extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';

    public function mount()
    {
        $this->reset();
    }

    #[On('admin-create-transaction')]
    #[On('admin-update-transaction')]
    public function render()
    {
        return view('livewire.admin.transactions', [
            // 'transactions' => Transaction::latest()
            //     ->join('carts', 'transactions.id', '=', 'carts.transaction_id')
            //     ->leftJoin('discount_codes', 'transactions.discount_code_id', '=', 'discount_codes.id')
            //     ->select('carts.seat_id', 'carts.name', 'discount_codes.code as discount_code', 'transactions.*')
            //     ->where('payment_status', 'paid')
            //     ->search($this->search)
            //     ->paginate(10),
            'transactions' => Transaction::latest()->where('payment_status', 'paid')->search($this->search)->paginate(10),
            'totalTransactions' => Transaction::where('payment_status', 'paid')->count(),
        ]);
    }
}
