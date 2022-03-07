<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    //public variables are automatically available to the component view
    public $count = 3;

    public function increment()
    {
        //$this->count = $this->count + 1;
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    //every component class has a render function
    //the render functions returns a component view
    public function render()
    {
        return view('livewire.counter');
    }
}
