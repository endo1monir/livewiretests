<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PollExample extends Component
{
    public $revenue;
    public function mount(){
        $this->revenue=$this->getRevenue();
    }
    public function getRevenue(){
     return   $this->revenue=DB::table('orders')->sum('price');

    }
    public function render()
    {
        return view('livewire.poll-example');
    }
}
