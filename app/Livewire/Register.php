<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Register extends Component
{
    public $name = '';
    public $username = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function createNewUser(){
        $validate = $this->validate([
            'name' => 'required|min:2|max:50',
            'username' => 'required|min:2|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:2|confirmed:password_confirmation'
        ]);

        

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        $this->reset(['name', 'username', 'email', 'password', 'password_confirmation']);
        session()->flash('success', 'Account created successfully!');
        $this->redirect('/login');
    }

    public function rander() {
        return view('livewire.auth.register');
    }
}
