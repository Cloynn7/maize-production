<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class UpdateTransactionModal extends Component
{
    use WithFileUploads;

    public $transaction, $carts, $user;
    public $status, $paymentProof;

    #[On('admin-get-transaction')]
    public function getTransaction($id)
    {
        $this->reset();
        $this->transaction = Transaction::where('id', $id)->first();
        $this->status = $this->transaction->status;
        $this->carts = $this->transaction->cart()->where('transaction_id', $id)->get();
        foreach ($this->carts as $cart) {
            $this->user = $cart->user;
        };
    }

    public function updateTransaction()
    {
        $data = $this->validate([
            'status' => 'required',
            'paymentProof' => 'nullable|image|max:2048',
        ]);

        if ($data['paymentProof']) {
            $imagePath = $this->paymentProof->store('paymentProof', 'public');
            $data['paymentProof'] = $imagePath;
        }

        Transaction::where('id', $this->transaction->id)->update([
            'status' => $data['status'],
            'payment_proof' => $data['paymentProof'],
        ]);
        $this->dispatch('admin-update-transaction');
        return session()->flash('success', 'Transaction updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.update-transaction-modal');
    }
}
