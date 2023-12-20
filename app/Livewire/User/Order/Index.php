<?php

namespace App\Livewire\User\Order;

use App\Models\Cart;
use App\Models\Seat;
use Livewire\Component;
use Livewire\Attributes\Url;

class Index extends Component
{
    #[Url(as: 'class')]
    public $class =  'regular';
    public $name, $selectedSeat;

    public function addToCart()
    {
        $this->name = $this->name ?? auth()->user()->firstName . ' ' . auth()->user()->lastName;
        $this->validate([
            'selectedSeat' => 'required',
        ]);
        $seat = Seat::find($this->selectedSeat);
        $price = $seat->price;
        Cart::create([
            'name' => $this->name,
            'user_id' => auth()->id(),
            'seat_id' => $this->selectedSeat,
            'price' => $price,
        ]);
        $this->reset('name', 'selectedSeat');
        return redirect()->route('cart');
    }

    public function render()
    {
        $classes = Seat::all()->pluck('class')->unique();
        return view('livewire.user.order.index', [
            'seats' => Seat::latest()
            ->where('status', 'available')
            ->where('class', $this->class)
            ->get(),
            'classes' => $classes,
        ]);
    }
}
