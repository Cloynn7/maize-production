<?php

namespace App\Livewire;

use App\Models\Seat;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;

#[Lazy]
#[Layout('layouts.app')]
class Test extends Component
{
    #[Url(as: 'q')]
    public $search = '';

    public function render()
    {
        if ($this->search) {
            $seats = Seat::latest()
                ->where('status', 'available')
                ->where('seat', 'like' , '%' . $this->search . '%')
                ->get();
        } else {
            $seats = Seat::latest()
                ->where('status', 'available')
                ->get();
        }

        return view('livewire.test', [
            'seats' => $seats,
        ]);
    }
}
