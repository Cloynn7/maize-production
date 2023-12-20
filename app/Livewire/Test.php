<?php

namespace App\Livewire;

use App\Models\Seat;
use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;

// #[Lazy]
#[Layout('layouts.app')]
class Test extends Component
{
    public function render()
    {
        return view('livewire.test', [
            'seats' => Seat::latest()->paginate(10),
            'totalSeats' => Seat::count(),
        ]);
    }
}
