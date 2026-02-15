<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FollowButton extends Component
{
    public $userId;
    public $isFollowing = false;
    public $followerCount = 0;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->loadFollowStatus();
    }

    public function loadFollowStatus()
    {
        $user = User::find($this->userId);
        
        if ($user && Auth::check()) {
            $this->isFollowing = User::find(Auth::id())->isFollowing($this->userId);
            $this->followerCount = $user->followers_count ?? $user->followers()->count();
        }
    }

    public function toggleFollow()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = User::find($this->userId);
        
        if (!$user || $user->id === Auth::id()) {
            return;
        }

        $currentUser = User::find(Auth::id());
        if ($this->isFollowing) {
            // Unfollow
            $currentUser->following()->detach($this->userId);
            $this->followerCount--;
        } else {
            // Follow
            $currentUser->following()->attach($this->userId);
            $this->followerCount++;
        }

        $this->isFollowing = !$this->isFollowing;
        
        // Dispatch event to update any other components (like Profile)
        $this->dispatch('followUpdated')->to(Profile::class);
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}