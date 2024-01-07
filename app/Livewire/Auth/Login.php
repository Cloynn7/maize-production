<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            if (auth()->user()->is_admin) {
                $this->reset();
                Alert::success('Success', 'Login Successfull, you are now logged in!');
                return redirect()->route('admin.dashboard');
            } else {
                $this->reset();
                Alert::success('Success', 'Login Successfull, you are now logged in!');
                return redirect()->route('user.dashboard');
            }
        } else {
            return session()->flash('error', 'Please check your credentials.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->title('Login | ' . config('app.name'));
    }
}
