<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CreatePost extends Component
{
    use WithFileUploads;

    public $caption;
    public $location;
    public $image;
    
    protected $rules = [
        'caption' => 'nullable|max:1000',
        'location' => 'nullable|max:255',
        'image' => 'required|image|max:10240', // 10MB max
    ];

    protected $messages = [
        'image.required' => 'Please select an image.',
        'image.image' => 'File must be an image.',
        'image.max' => 'Image size cannot exceed 10MB.',
        'caption.max' => 'Caption cannot exceed 1000 characters.',
    ];

    public function save()
    {
        $this->validate();

        // Store the image
        $imagePath = $this->image->store('posts', 'public');

        // Create the post
        Post::create([
            'user_id' => Auth::id(),
            'caption' => $this->caption,
            'location' => $this->location,
            'image_path' => '/storage/' . $imagePath,
        ]);

        // Clear form
        $this->reset(['caption', 'location', 'image']);

        // Flash success message
        session()->flash('message', 'Post created successfully!');

        // Redirect to feed
        return $this->redirect('/feed');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}