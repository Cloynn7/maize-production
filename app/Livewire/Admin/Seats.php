<?php

namespace App\Livewire\Admin;

use App\Models\Seat;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;

#[Lazy]
class Seats extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';

    public function mount()
    {
        $this->reset();
    }

    public function delete($id)
    {
        Seat::findOrFail($id)->delete();
        return session()->flash('bannerSuccess', 'Seat deleted successfully!');
    }

    #[On('admin-create-seat')]
    #[On('admin-update-seat')]
    public function render()
    {
        return view('livewire.admin.seats', [
            'seats' => Seat::latest()->search($this->search)->paginate(10),
            'totalSeats' => Seat::count(),
        ]);
    }
}
