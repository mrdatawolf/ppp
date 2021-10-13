<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class PickVendor extends Component
{
    public int   $vendor;
    public array $vendors;

    public function mount()
    {
        $this->vendor = 0;

        $vendors = Vendor::orderBy('name')->get();
        $this->vendors = [0 => 'Select Vendor'];
        foreach($vendors as $vendor) {
            $this->vendors[$vendor->id] = $vendor->name;
        }
    }

    public function updatedVendor() {
        $this->emit('vendorChanged', ($this->vendor == 0) ? '' : $this->vendors[$this->vendor]);
    }


    public function render()
    {
        return view('livewire.pick-vendor');
    }
}
