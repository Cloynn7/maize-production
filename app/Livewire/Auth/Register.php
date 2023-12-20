<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class Register extends Component
{
    public $firstName, $lastName, $email, $phone, $password, $confirmPassword;
    public function register()
    {
        $credentials = $this->validate([
            'firstName' => 'required|min:3|max:255',
            'lastName' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:255|unique:users,phone',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);

        $credentials['password'] = bcrypt($credentials['password']);
        if (User::create($credentials)) {
            Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password']
            ]);
            Alert::success('Success', 'Your registration is successfull, and you are now logged in!');
            return redirect()->route('user.dashboard');
        } else {
            Alert::error('Error', 'Something went wrong, please try again!');
            return redirect()->back();
        }
    }
    public function render()
    {
        return view('livewire.auth.register')->title('Register | ' . config('app.name'));
    }
}
