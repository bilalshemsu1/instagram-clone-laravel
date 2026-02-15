<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Feed extends Component
{
    public $posts;

    public function mount(){
        $this->posts = Post::with('user')->latest()->get();
    }


    public function render()
    {

        return view('livewire.feed');
    }
}
