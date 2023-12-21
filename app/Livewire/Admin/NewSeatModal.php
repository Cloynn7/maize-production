<?php

namespace App\Livewire\Admin;

use App\Models\Seat;
use Livewire\Attributes\On;
use Livewire\Component;

class NewSeatModal extends Component
{
    public $seat, $status = 'available', $class = null, $price;

    public function mount()
    {
        $this->reset();
    }

    public function createSeat()
    {
        $data = $this->validate([
            'seat' => 'required|max:255|unique:seats,seat',
            'status' => 'required',
            'class' => 'required',
            'price' => 'required|integer',
        ]);
        if (Seat::create($data)) {
            $this->reset();
            $this->dispatch('admin-create-seat');
            return session()->flash('success', 'Seat created successfully!');
        } else {
            return session()->flash('error', 'Something went wrong, please try again!');
        }
    }
    public function render()
    {
        return view('livewire.admin.new-seat-modal', [
            'classes' => Seat::all()->pluck('class')->unique(),
        ]);
    }
}
