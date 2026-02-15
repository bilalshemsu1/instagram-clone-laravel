<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Edit Profile')]
class EditProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $username;
    public $email;
    public $bio;
    public $profile_photo;
    public $currentPhoto;
    
    // Password fields (optional)
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'username' => 'required|alpha_dash|min:3|max:255|unique:users,username',
        'bio' => 'nullable|max:500',
        'profile_photo' => 'nullable|image|max:2048', // 2MB max
        'current_password' => 'nullable|required_with:new_password|current_password',
        'new_password' => 'nullable|min:8|confirmed',
    ];

    protected $messages = [
        'current_password.required_with' => 'Please enter your current password',
        'current_password.current_password' => 'Current password is incorrect',
        'new_password.confirmed' => 'Password confirmation does not match',
        'profile_photo.image' => 'File must be an image',
        'profile_photo.max' => 'Image size cannot exceed 2MB',
        'username.unique' => 'This username is already taken',
        'username.alpha_dash' => 'Username can only contain letters, numbers, dashes and underscores',
    ];

    public function mount()
    {
        $user = Auth::user();
        
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->bio = $user->bio;
        $this->currentPhoto = $user->profile_picture;
    }

    public function updatedUsername()
    {
        // Validate username uniqueness excluding current user
        $this->validateOnly('username', [
            'username' => 'unique:users,username,' . Auth::id(),
        ]);
    }

    public function save()
    {
        // Special rule for username to ignore current user
        $rules = $this->rules;
        $rules['username'] = 'required|alpha_dash|min:3|max:255|unique:users,username,' . Auth::id();
        
        $this->validate($rules);

        $user = User::find(Auth::id());
                
        // Update basic info
        $user->name = $this->name;
        $user->username = $this->username;
        $user->bio = $this->bio;
        
        // Update password if provided
        if ($this->new_password) {
            $user->password = Hash::make($this->new_password);
        }
        
        // Handle profile photo upload
        if ($this->profile_photo) {
            $path = $this->profile_photo->store('profile-photos', 'public');
            $user->profile_picture = '/storage/' . $path;
        }
        
        $user->save();
        
        // Clear password fields
        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';
        
        session()->flash('message', 'Profile updated successfully!');
        
        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}