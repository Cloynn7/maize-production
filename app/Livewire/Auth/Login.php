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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            if (auth()->user()->is_admin) {
                $this->reset();
                Alert::success('Success', 'Login Successfull, you are now logged in!');
                return redirect()->route('admin.dashboard');
                // return redirect()->route('admin.dashboard')->with('success', 'Login Successfull, you are now logged in!');
            } else {
                $this->reset();
                Alert::success('Success', 'Login Successfull, you are now logged in!');
                return redirect()->route('user.dashboard');
                // return redirect()->route('user.dashboard')->with('success', 'Login Successfull, you are now logged in!');
            }
        } else {
            $this->reset();
            Alert::error('Error', 'The provided credentials do not match our records.');
            return redirect()->back();
            // return redirect()->back()->with('error', 'The provided credentials do not match our records.');
        }
    }
    public function render()
    {
        return view('livewire.auth.login')->title('Login | ' . config('app.name'));
    }
}
