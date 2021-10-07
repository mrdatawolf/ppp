<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PickVendor extends Component
{
    public int   $vendor;
    public array $vendors;


    public function mount()
    {
        $this->vendor = 0;

        $this->vendors = [
            0 => 'Select Vendor',
            1 => 'Jansport',
            2 => 'Carhart'
        ];
    }

    public function vendorChange() {
        $this->emit('vendorChanged', ($this->vendor == 0) ? '' : $this->vendors[$this->vendor]);
    }


    public function render()
    {
        return view('livewire.pick-vendor');
    }
}
