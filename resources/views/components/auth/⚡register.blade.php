
<?php

use Livewire\Component;
use App\Models\User;

new class extends Component
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
    }
}
?>

<div class="min-h-screen bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Create Instagram Account</h1>
        
        <form wire:submit="createNewUser">
            <div class="space-y-4">
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" 
                           wire:model="name" 
                           name="name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                    @error('name')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>

                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" 
                           wire:model="username" 
                           name="username"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                    @error('username')
                        <p class="error">{{$message}}</p>
                    @enderror        
                </div>

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

                <!-- Password Confirmation Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Password Confirmation</label>
                    <input type="password" 
                           wire:model="password_confirmation" 
                           name="password_confirmation"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                    @error('password_confirmation')
                        <p class="error">{{$message}}</p>
                    @enderror 
                </div>

                <!-- Submit Button -->
                <button
                        type="submit" 
                        class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                    Create Account
                </button>
            </div>
        </form>
        <p class="mt-5">Already have account? 
            <a href="/login" class="text-red-500 font-bold">Login</a>
        </p>
    </div>
</div>