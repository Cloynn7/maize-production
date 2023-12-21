<?php

namespace App\Livewire\Admin;

use App\Models\Seat;
use Livewire\Component;
use Livewire\Attributes\On;

class UpdateSeatModal extends Component
{
    public $seat, $seatId, $status = 'available', $class = null, $price;

    #[On('admin-get-seat')]
    public function getSeat($id)
    {
        $this->reset();
        $this->seatId = $id;
        $seat = Seat::where('id', $id)->first();
        $this->seat = $seat->seat;
        $this->status = $seat->status;
        $this->class = $seat->class;
        $this->price = $seat->price;
    }

    public function updateSeat()
    {
        $data = $this->validate([
            'seat' => 'required|max:255',
            'status' => 'required',
            'class' => 'required',
            'price' => 'required|integer',
        ]);

        $query = Seat::where('id', $this->seatId)->update([
            'seat' => $data['seat'],
            'status' => $data['status'],
            'class' => $data['class'],
            'price' => $data['price'],
        ]);

        if ($query) {
            $this->reset();
            $this->dispatch('admin-update-seat');
            return session()->flash('success', 'Seat ' . $this->seat . ' updated successfully!');
        } else {
            return session()->flash('error', 'Something went wrong, please try again!');
        }
    }

    public function render()
    {
        return view('livewire.admin.update-seat-modal', [
            'seat' => $this->seat ?? null,
            'classes' => Seat::all()->pluck('class')->unique(),
        ]);
    }
}
