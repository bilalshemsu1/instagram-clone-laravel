<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Feed extends Component
{
    public $posts;
    public $newComments = []; // Track new comment inputs per post

    public function mount(){
        $this->loadPosts();
        $this->initializeNewComments();
    }

    public function initializeNewComments()
    {
        foreach ($this->posts as $post) {
            $this->newComments[$post->id] = '';
        }
    }

    public function loadPosts(){
        $this->posts = Post::with(['user', 'comments.user']) // Load comments with their users
            ->withCount(['likes', 'comments']) // Add comments_count
            ->latest()
            ->get();
        
        $this->initializeNewComments();
    }

    public function toggleLike($postId) {
        $post = Post::find($postId);

        if(!$post){
            return;
        }

        $existingLike = Like::where('user_id', Auth::id())
            ->where('post_id', $postId)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $postId
            ]);
        }

        $this->loadPosts();
    }

    public function addComment($postId)
    {
        $this->validate([
            "newComments.$postId" => 'required|min:1|max:500'
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'content' => $this->newComments[$postId]
        ]);

        // Clear the comment input
        $this->newComments[$postId] = '';
        
        // Reload posts to show new comment
        $this->loadPosts();
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        
        // Check if user owns this comment
        if ($comment && $comment->user_id === Auth::id()) {
            $comment->delete();
            $this->loadPosts();
        }
    }

    public function render()
    {
        return view('livewire.feed');
    }
}