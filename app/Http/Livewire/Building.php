<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class Building extends Component
{
    public function render()
    {
        $data = Task::orderBy('sort_id', 'asc')->get();
       // return view('menu', compact('data'));
        return view('livewire.building',compact('data'));
    }

   
}
