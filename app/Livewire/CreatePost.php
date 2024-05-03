<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreatePost extends Component
{
    public $title = '';

    public $content = '';

    public function save()
    {
        Post::create(
            $this->only(['title', 'content'])
        );

        return $this->redirect('/posts')
            ->with('status', 'Post successfully created.');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
