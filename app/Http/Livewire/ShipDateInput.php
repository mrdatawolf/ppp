<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class ShipDateInput extends Component
{
    public string $shipDate;

    public function mount() {
        $this->shipDate = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.ship-date-input');
    }
}
