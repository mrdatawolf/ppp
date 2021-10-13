<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class OrderDateInput extends Component
{
    public string $orderDate;
    public bool   $shouldDisplay;

    protected $listeners = ['vendorChanged'];


    public function mount()
    {
        $this->orderDate     = Carbon::now()->format('Y-m-d');
        $this->shouldDisplay = false;
    }


    public function vendorChanged($name)
    {
        $this->shouldDisplay = ! empty($name);
    }


    public function render()
    {
        return view('livewire.order-date-input');
    }
}
