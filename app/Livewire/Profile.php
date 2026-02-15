<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
#[Title('Profile')]
class Profile extends Component
{
    public $user;
    public $posts;
    public $isOwnProfile = false;
    public $followersCount = 0;
    public $followingCount = 0;
    public $postsCount = 0;

    public function mount($username = null)
    {
        // If username is provided, show that user's profile
        // If not, show logged in user's profile
        if ($username) {
            $this->user = User::where('username', $username)->firstOrFail();
        } else {
            $this->user = Auth::user();
        }

        $this->isOwnProfile = Auth::id() === $this->user->id;
        $this->loadUserData();
    }

    public function loadUserData()
    {
        // Load user's posts with counts
        $this->posts = Post::where('user_id', $this->user->id)
            ->withCount(['likes', 'comments'])
            ->latest()
            ->get();

        $this->postsCount = $this->posts->count();
        
        // These will be used when we add follow system
        // $this->followersCount = $this->user->followers->count();
        // $this->followingCount = $this->user->following->count();
    }

    public function render()
    {
        return view('livewire.profile');
    }
}