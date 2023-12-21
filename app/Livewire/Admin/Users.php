<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;

#[Lazy]
class Users extends Component
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
        User::findOrFail($id)->delete();
        return session()->flash('bannerSuccess', 'User deleted successfully!');
    }

    #[On('admin-create-user')]
    #[On('admin-update-user')]
    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::latest()
                ->search($this->search)
                ->paginate(10),
            'totalUsers' => User::count()
            // ])->title('Admin - Users | ' . config('app.name'));
        ]);
    }
}
