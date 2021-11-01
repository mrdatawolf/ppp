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
        $this->chevron = 'chevron_right';
        $this->vendorSearchName       = '';
    }


    public function flipList()
    {
        if(empty($this->vendorSearchName) || $this->chevron === 'chevron_right') {
            $this->chevron = ($this->chevron === 'chevron_right') ? 'expand_more' : 'chevron_right';
            $this->emit('flipChevron', $this->chevron);
        }
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
        if ($this->vendorSearchName !== $this->vendor->name) {
            $this->emit('vendorSearchNameChanged', $this->vendorSearchName);
        }
    }


    public function render()
    {
        return view('livewire.pick-vendor');
    }
}
