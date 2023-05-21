<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TagsComponent extends Component
{
    public $tags;
    protected $listeners = ['tagAdded','tagRemoved'];
    public function tagAdded($tag){
        Tag::create([
            'name' => $tag
        ]);
        $this->emit('tagAddedFromBackend',$tag);
    }
    public function tagRemoved($tag){
        Tag::where('name',$tag)->first()->delete();
    }
    public function mount(){
        $tags=Tag::all();
        $this->tags=json_encode($tags->pluck('name'));
    }
    public function render()
    {
        return view('livewire.tags-component');
    }
}
