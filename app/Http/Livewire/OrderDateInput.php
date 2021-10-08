<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class OrderDateInput extends Component
{
    public string $orderDate;

    public function mount() {
        $this->orderDate = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.order-date-input');
    }
}
