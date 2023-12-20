<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class Dashboard extends Component
{
    public $firstName, $lastName, $email, $phone, $password;
    public $currentPassword, $newPassword, $confirmPassword;

    public function mount()
    {
        $user = auth()->user();
        
        $this->firstName = $user->firstName;
        $this->lastName = $user->lastName;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    public function update()
    {
        $credentials = $this->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        if (auth()->user() && Hash::check($this->password, auth()->user()->password)) {
            User::where('id', auth()->user()->id)->update([
                'firstName' => $credentials['firstName'],
                'lastName' => $credentials['lastName'],
                'email' => $credentials['email'],
                'phone' => $credentials['phone'],
            ]);
            Alert::success('Success', 'Your update was successful. Changes have been saved.');
            return redirect()->route('user.dashboard');
            // return redirect()->route('user.dashboard')->with('success', 'Your update was successful. Changes have been saved.');
        } else {
            Alert::error('Error', 'Sorry, the password you entered is incorrect!');
            return redirect()->back();
            // return redirect()->back()->with('error', 'Sorry, the password you entered is incorrect!');
        }
    }

    public function changePassword()
    {
        $credentials = $this->validate([
            'currentPassword' => 'required|string|min:6',
            'newPassword' => 'required|string|min:6',
            'confirmPassword' => 'required|string|min:6|same:newPassword',
        ]);

        if(auth()->user() && Hash::check($credentials['currentPassword'], auth()->user()->password)) {
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make($credentials['newPassword']),
            ]);
            Alert::success('Success', 'Your password has been changed.');
            return redirect()->back();
            // return redirect()->back()->with('success', 'Your password has been changed.');
        } else {
            Alert::error('Error', 'Sorry, the password you entered is incorrect!');
            return redirect()->back();
            // return redirect()->back()->with('error', 'Sorry, the password you entered is incorrect!');
        }
    }
    public function render()
    {
        return view('livewire.user.dashboard')->title('Dashboard | ' . config('app.name'));
    }
}
