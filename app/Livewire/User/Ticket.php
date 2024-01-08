<?php

namespace App\Livewire\User;

use Livewire\Component;

class Ticket extends Component
{
    public function render()
    {
        return view('livewire.user.ticket', [
            'datas' => auth()->user()->cart()->whereHas('transaction', function ($query) {
                $query->where('status', 'accepted');
            })->get(),
        ]);
    }
}
