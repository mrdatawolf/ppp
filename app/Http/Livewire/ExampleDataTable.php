<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExampleDataTable extends Component
{
    public bool  $hasData;
    public array $data;
    public bool  $shouldDisplay;

    protected $listeners = ['importProcessed', 'vendorChanged'];


    public function mount()
    {
        $this->hasData       = false;
        $this->shouldDisplay = false;
        $this->data          = [];
    }


    public function vendorChanged($name)
    {
        $this->shouldDisplay = ! empty($name);
    }


    public function importProcessed($data)
    {
        $this->hasData = ( ! empty($data));
        $this->data    = $data;
    }


    public function render()
    {
        return view('livewire.example-data-table');
    }
}
