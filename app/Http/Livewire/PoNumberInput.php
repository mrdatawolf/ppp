<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class PoNumberInput extends Component
{
    public string $poNumber;
    public bool   $shouldDisplay;

    protected $listeners = ['vendorChanged'];
    protected $casts = ['vendor' => 'collection'];


    public function mount()
    {
        $this->poNumber      = Carbon::now()->format('mdy');
        $this->updatedPoNumber($this->poNumber);
        $this->shouldDisplay = false;
    }


    public function updatedPoNumber($number)
    {
        $this->emit('poNumberChanged', $number);
    }


    public function vendorChanged($vendor)
    {
        $this->shouldDisplay = ! empty($vendor['name']);
    }


    public function render()
    {
        return view('livewire.po-number-input');
    }
}
