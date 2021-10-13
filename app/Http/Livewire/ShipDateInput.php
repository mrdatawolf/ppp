<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class ShipDateInput extends Component
{
    public string $shipDate;
    public bool   $shouldDisplay;

    protected $listeners = ['vendorChanged'];


    public function mount()
    {
        $this->shipDate      = Carbon::now()->format('Y-m-d');
        $this->shouldDisplay = false;
    }


    public function vendorChanged($name)
    {
        $this->shouldDisplay = ! empty($name);
    }


    public function render()
    {
        return view('livewire.ship-date-input');
    }
}
