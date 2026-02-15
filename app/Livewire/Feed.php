<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Feed extends Component
{
    public $posts;

    public function mount(){
        $this->loadPosts();
    }

    public function loadPosts(){
        $this->posts = Post::with('user')
            ->withCount('likes')
            ->latest()
            ->get();
    }

    public function toggleLike($postId) {

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $post = Post::find($postId);

        if(!$post){
            return;
        }

        $existingLike = Like::where('user_id', Auth::id())
            ->where('post_id', $postId)
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
        } else {
            // Like
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $postId
            ]);
        }

        // Refresh posts to update like counts
        $this->loadPosts();

    }


    public function render()
    {

        return view('livewire.feed');
    }
}
