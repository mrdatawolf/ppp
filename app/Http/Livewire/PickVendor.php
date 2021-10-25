<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class PickVendor extends Component
{
    public string $vendorName;
    public bool   $showExpandedList;
    protected     $vendor;

    protected $listeners = ['possibleVendorChanged'];

    public function mount()
    {
        $this->vendor           = (object)[];
        $this->showExpandedList = true;
        $this->vendorName       = '';
    }

    public function flipListIcon() {
        $this->showExpandedList = ! $this->showExpandedList;
    }

    public function possibleVendorChanged($name) {
        if($name !== $this->vendorName) {
            $this->vendorName = $name;
            $this->updatedVendorName();
        }
    }

    public function updatedVendorName()
    {
        $this->getVendor();
        $this->emit('vendorNameChanged', $this->vendorName);
    }

    public function getVendor() {
        $vendor = Vendor::where('name','like', '%' . $this->vendorName . '%');
        if($vendor->count() === 1) {
            $this->vendor = $vendor->first();
            $this->emit('vendorChanged', $this->vendor);
        }
    }


    public function render()
    {
        return view('livewire.pick-vendor');
    }
}
