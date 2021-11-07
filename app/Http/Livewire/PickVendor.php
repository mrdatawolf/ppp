<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class PickVendor extends Component
{
    public string $vendorSearchName;
    public string $chevron;
    protected     $vendor;

    protected $listeners = ['vendorPicked'];


    public function mount()
    {
        $this->vendor           = (object)[];
        $this->vendorSearchName       = '';
    }


    /**
     * @param $name
     */
    public function vendorPicked($name)
    {
        $vendorQuery = Vendor::where('name', 'like', '%'.$this->vendorSearchName.'%');
        if ($vendorQuery->count() === 1) {
            $this->vendor = $vendorQuery->first();
            $this->emit('vendorChanged', $this->vendor);
        }
    }


    public function updatedVendorSearchName()
    {
        if (empty($this->vendor->name) || $this->vendorSearchName !== $this->vendor->name) {
            $this->emit('vendorSearchChanged', $this->vendorSearchName);
        }
    }


    public function render()
    {
        return view('livewire.pick-vendor');
    }
}
