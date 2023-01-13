<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notif extends Component
{
    public $temps;

    protected $listeners = ['refreshNotif' => '$refresh'];
    public function updating(){
        $this->temps = $this->temps;
        $this->emit('refreshNotif');

    }
    public function render()
    {
        return view('livewire.notif');
    }
}
