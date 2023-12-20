<?php

namespace App\Livewire\User\Order;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class Checkout extends Component
{
    use WithFileUploads;

    public $carts, $tid, $subtotal, $total, $promoCode, $offer;
    public $paymentProof;

    public function mount()
    {
        $this->reset();
        $session = session()->get('transaction');
        // ! MENIMBANG HP YANG RAMNYA KECIL, JADI KALAU BUKA APP BANYAK MALAH KE REFRESH HALAMANNYA, SEDANGKAN PAGE INI DI DESIGN AGAR SAAT DI REFRESH AKAN BALIK KE CART, AKU MENGGUNAKAN SESSION FLASH MAKA AKU BISA MENYIMPAN (KEEP) DATA SESSIONNYA, 
        // * ATAU MEMANG JANGAN MENGGUNAKAN FLASH SAAT MENGIRIMKAN DATA?
        if ($session) {
            session()->keep(['transaction']);
            $this->carts = $session['carts'];
            $this->tid = $session['tid'];
            $this->subtotal = $session['subtotal'];
            $this->total = $session['total'];
            $this->promoCode = $session['promoCode'] ?? "-";
            $this->offer = $session['offer'];
        } else {
            return redirect()->route('cart');
        }
    }

    public function newOrder()
    {
        if ($this->carts->pluck('seat.status')->contains('booked')) {
            session()->flash('error', 'One or more seats in your cart are already booked! If you already paid, please select another available seats or contact our admin.');
            return;
        }

        $this->validate([
            'paymentProof' => 'required|image|max:2048',
        ]);
        $imagePath = $this->paymentProof->store('paymentProof', 'public');
        if ($imagePath) {
            Transaction::where('id', $this->tid)->update([
                'payment_proof' => $imagePath,
                'payment_status' => 'paid',
                'status' => 'processed',
                'updated_at' => now(),
            ]);

            $this->carts->each(function ($cart) {
                $cart->seat->update([
                    'status' => 'booked',
                ]);
            });
        }

        session()->flash('success', 'Order successfully created! Please wait for confirmation.');
    }

    public function render()
    {
        return view('livewire.user.order.checkout', [
            'items' => $this->carts,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'promoCode' => $this->promoCode,
            'offer' => $this->offer,
        ])->title('Checkout | ' . config('app.name'));
    }
}
