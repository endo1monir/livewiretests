<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataTables extends Component
{
    use WithPagination;

    public $active = true;
    public $search;
    public $sortField;
    public $sortASC = true;
    protected $queryString = ['search','active','sortASC','sortField'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingActive()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {

        if ($this->sortField == $field) {
            $this->sortASC = !$this->sortASC;
        } else {
            $this->sortASC = true;
        }
        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.data-tables', ['users' =>
            User::query()->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')->
                orWhere('email', 'like', '%' . $this->search . '%');
            })->
            where('active', $this->active)
                ->when($this->sortField, function ($query) {
                    $query->orderBy($this->sortField, $this->sortASC ? 'asc' : 'desc');
                })
                ->paginate(10)]);
    }

    public function paginationView()

    {

        return 'livewire.custom-pagination-links-view';

    }
}
