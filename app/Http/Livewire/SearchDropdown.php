<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search;
    public $searchResultes = [];

    public function updatedSearch($newValue)
    {
        if (strlen($this->search)<3):
            $this->searchResultes=[];
        return;
        endif;
        $response = Http::get('https://itunes.apple.com/search/?term=' . $this->search . '&limit=10');
//        dd($response->json());
        $this->searchResultes = $response->json()['results'];
//        dump($this->searchResultes);
    }

    public function render()
    {

        return view('livewire.search-dropdown');
    }
}
