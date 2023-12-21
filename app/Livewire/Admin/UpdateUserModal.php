<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class UpdateUserModal extends Component
{
    public $user, $userId;
    // public $updateFirstName, $updateLastName, $updateEmail, $updatePhone, $updateIsAdmin = false, $resetPassword;
    public $firstName, $lastName, $email, $phone, $password, $isAdmin = false, $resetPassword;

    public function mount()
    {
        $this->reset();
    }

    #[On('admin-get-user')]
    public function getUser($id)
    {
        $this->reset();
        $this->user = User::where('id', $id)->first();
        $this->userId = $this->user->id;
        $this->firstName = $this->user->firstName;
        $this->lastName = $this->user->lastName;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        if ($this->user->is_admin) {
            $this->isAdmin = true;
        } else {
            $this->isAdmin = false;
        }
    }

    public function updateUser()
    {
        $this->resetPassword = $this->resetPassword == true ? true : false;
        $credentials = $this->validate([
            'firstName' => 'required|min:3|max:255',
            'lastName' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'phone' => 'required|max:255|unique:users,phone,' . $this->userId,
            'isAdmin' => 'boolean',
        ]);
        switch ($this->resetPassword) {
            case true:
                User::where('id', $this->userId)->update([
                    'firstName' => $credentials['firstName'],
                    'lastName' => $credentials['lastName'],
                    'email' => $credentials['email'],
                    'phone' => $credentials['phone'],
                    'password' => bcrypt('MAIZE@123'),
                    'is_admin' => $credentials['isAdmin'],
                ]);
                $this->dispatch('admin-update-user');
                return session()->flash('success', 'User ' . $this->firstName . ' ' . $this->lastName . ' updated successfully!');
            case false:
                User::where('id', $this->userId)->update([
                    'firstName' => $this->firstName,
                    'lastName' => $this->lastName,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'is_admin' => $this->isAdmin,
                ]);
                $this->dispatch('admin-update-user');
                return session()->flash('success', 'User ' . $this->firstName . ' ' . $this->lastName . ' updated successfully!');
            default:
                return session()->flash('error', 'Something went wrong, please try again!');
        };
    }

    public function render()
    {
        return view('livewire.admin.update-user-modal', [
            'user' => $this->user ?? null,
        ]);
    }
}
