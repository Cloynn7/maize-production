<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\discount_code as DiscountCode;

class Discounts extends Component
{
    use WithPagination;
    #[Url(as: 'q')]
    public $search;

    public function mount()
    {
        $this->reset();
    }

    public function delete($id)
    {
        DiscountCode::findOrFail($id)->delete();
        return session()->flash('bannerSuccess', 'Discount deleted successfully!');
    }

    #[On('admin-new-discounts')]
    #[On('admin-update-discounts')]
    public function render()
    {
        return view('livewire.admin.discounts', [
            'totalDiscounts' => DiscountCode::count(),
            'discounts' => DiscountCode::with(['transactions' => function ($query) {
                $query->where('status', 'accepted')->select('discount_code_id', DB::raw('count(*) as use_count'))
                    ->groupBy('discount_code_id');
            }])
                ->latest()
                ->search($this->search)
                ->paginate(10),
        ]);
    }
}
