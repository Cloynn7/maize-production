<?php

namespace App\Livewire\Admin;

use DateTime;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\discount_code as DiscountCode;

class UpdateDiscountModal extends Component
{
    public $code, $codeId, $min_price, $offer, $type = null, $max_offer, $start_date, $expire_date;

    #[On('admin-get-discount')]
    public function getDiscount($id)
    {
        $this->reset();
        $this->codeId = $id;
        $discount = DiscountCode::where('id', $id)->first();
        $this->code = $discount->code;
        $this->min_price = $discount->min_price;
        $this->offer = $discount->offer;
        $this->type = $discount->type;
        $this->max_offer = $discount->max_offer;
        $this->start_date = $discount->start_date;
        $this->expire_date = $discount->expire_date;
    }

    public function updateCode()
    {
        $data = $this->validate([
            'code' => 'required|unique:discount_codes,code,' . $this->codeId,
            'min_price' => 'numeric|nullable',
            'offer' => 'required|numeric',
            'type' => 'required|in:flat,percentage',
            'max_offer' => 'numeric|nullable',
            'start_date' => 'date|nullable',
            'expire_date' => 'date|nullable',
        ]);

        $start_date = new DateTime($data['start_date']);
        $data['start_date'] = $start_date->format('Y-m-d H:i:s');
        $expire_date = new DateTime($data['expire_date']);
        $data['expire_date'] = $expire_date->format('Y-m-d H:i:s');

        $data['min_price'] = $data['min_price'] === '' ? null : $data['min_price'];
        $data['max_offer'] = $data['max_offer'] === '' ? null : $data['max_offer'];

        if (DiscountCode::where('id', $this->codeId)->update($data)) {
            $this->dispatch('admin-update-discounts');
            return session()->flash('success', 'Discount updated successfully!');
        } else {
            return session()->flash('error', 'Something went wrong!');
        }
    }

    public function render()
    {
        return view('livewire.admin.update-discount-modal', [
            'discountCode' => $this->code ?? null,
            'types' => ['flat', 'percentage'],
        ]);
    }
}
