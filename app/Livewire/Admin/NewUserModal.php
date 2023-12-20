<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class NewUserModal extends Component
{
    public $firstName, $lastName, $email, $phone, $password, $isAdmin;

    public function mount()
    {
        $this->reset();
    }

    public function createUser()
    {
        $this->isAdmin = $this->isAdmin ? true : false;
        $credentials = $this->validate([
            'firstName' => 'required|min:3|max:255',
            'lastName' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:255|unique:users,phone',
            'password' => 'required|min:6',
            'isAdmin' => 'boolean',
        ]);
        $credentials['password'] = bcrypt($credentials['password']);
        if (User::create($credentials)) {
            $this->reset();
            $this->dispatch('admin-create-user');
            return session()->flash('success', 'User created successfully!');
        } else {
            return session()->flash('error', 'Something went wrong, please try again!');
        }
    }

    public function render()
    {
        return view('livewire.admin.new-user-modal');
    }
}
