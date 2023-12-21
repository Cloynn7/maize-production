<?php

namespace App\Livewire\Admin;

use DateTime;
use Livewire\Component;
use App\Models\discount_code as DiscountCode;

class NewDiscountModal extends Component
{
    public $code, $min_price, $offer, $type = null, $max_offer, $start_date, $expire_date;

    public function mount()
    {
        $this->reset();
    }

    public function createCode()
    {
        $data = $this->validate([
            'code' => 'required|unique:discount_codes,code',
            'min_price' => 'numeric|nullable',
            'offer' => 'required|numeric',
            'type' => 'in:flat,percentage',
            'max_offer' => 'numeric|nullable',
            'start_date' => 'date|nullable',
            'expire_date' => 'date|nullable',
        ]);

        $start_date = new DateTime($data['start_date']);
        $data['start_date'] !== null ? $start_date->format('Y-m-d H:i:s') : null;
        $expire_date = new DateTime($data['expire_date']);
        $data['expire_date'] !== null ? $expire_date->format('Y-m-d H:i:s') : null;

        $data['min_price'] = $data['min_price'] === '' ? null : $data['min_price'];
        $data['max_offer'] = $data['max_offer'] === '' ? null : $data['max_offer'];

        if (DiscountCode::create($data)) {
            $this->dispatch('admin-new-discounts');
            return session()->flash('success', 'Discount created successfully!');
        } else {
            return session()->flash('error', 'Something went wrong!');
        }
    }
    
    public function render()
    {
        return view('livewire.admin.new-discount-modal', [
            'types' => ['flat', 'percentage'],
        ]);
    }
}
