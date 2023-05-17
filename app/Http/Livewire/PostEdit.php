<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostEdit extends Component
{
    use WithFileUploads;

    public $post;
    public $title;
    public $content;
    public $photo;
    public $successMessage;
    public $tempPhoto;
    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'photo' => 'nullable|image|sometimes|max:6000'
    ];

    public function updatedPhoto()
    {
        try {
         $this->tempPhoto=$this->photo->temporaryUrl();
        }
        catch (\Exception $e) {
            $this->tempPhoto = '';
        }
        $this->validate(['photo'=>'image|max:6000']);
    }

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;

    }

    public function submitForm()
    {
        $this->validate();
        $this->post->update([
                'title' => $this->title,
                'content' => $this->content,
                'photo' => $this->photo ? $this->photo->store('photos', 'public') : $this->post->photo ?? null
            ]
        );
        $this->successMessage = "Post updated successfully";
    }

    public function render()
    {
        return view('livewire.post-edit');
    }
}
