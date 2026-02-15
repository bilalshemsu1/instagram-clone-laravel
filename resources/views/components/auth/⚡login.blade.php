@extends('layouts.app')

@section('content')
<?php

use Livewire\Component;
use App\Models\User;

new class extends Component
{
    public $email = '';
    public $password = '';

    public function login(){
        $validate = $this->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:2'
        ]);

        Auth::attempt([
            'email'=>$this->email,
            'password'=>$this->password
        ]);

        // $this->reset(['name', 'username', 'email', 'password', 'password_confirmation']);

        session()->flash('success', 'Login Successful');
        $this->redirect('/register');
    }
}
?>

<div class="min-h-screen bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Welcome Back</h1>
        
        @if(session('success'))
            <p class="success">{{session('success')}}</p>
        @endif
        <form wire:submit="login">
            <div class="space-y-4">
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" 
                           wire:model="email" 
                           name="email"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                        @error('email')
                            <p class="error">{{$message}}</p>
                        @enderror  
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" 
                           wire:model="password" 
                           name="password"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                        @error('password')
                            <p class="error">{{$message}}</p>
                        @enderror 
                </div>

                <!-- Submit Button -->
                <button
                        type="submit" 
                        class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                    Login
                </button>
            </div>
        </form>
        <p class="mt-5">Don't have account? 
            <a href="/register" class="text-red-500 font-bold">Register</a>
        </p>
    </div>
</div>
@endsection