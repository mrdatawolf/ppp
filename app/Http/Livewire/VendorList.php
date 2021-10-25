<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Illuminate\Support\Collection;
use Livewire\Component;

class VendorList extends Component
{
    public Collection $vendors;
    public bool   $showExpandedList;
    public $vendor;
    public string $possibleVendorName;

    public $listeners = ['vendorChanged','flipVendorList', 'vendorNameChanged'];
    protected $casts = ['vendor' => 'collection','vendors' => 'collection'];

    public function mount() {
        $this->possibleVendorName = '';
        $this->showExpandedList = true;
        $this->getPossibleVendors();
    }

    public function vendorChanged($vendor) {
        $this->vendor = $vendor;
    }

    public function vendorNameChanged($name) {
        if($name !== $this->possibleVendorName) {
            $this->possibleVendorName = $name;
            $this->getPossibleVendors();
        }
    }

    public function updatedPossibleVendorName($name) {
        $this->possibleVendorName = $name;
        $this->getPossibleVendors();
        $this->emit('possibleVendorChanged', $name);
    }

    public function flipVendorList()
    {
        $this->showExpandedList = ! $this->showExpandedList;
    }

    protected function getPossibleVendors()
    {
        $getVendors = Vendor::select('id', 'name')->orderBy('name');
        $this->vendors = (empty($this->possibleVendorName))
            ? $getVendors->get()
            : $getVendors->where('name', 'like', '%'.$this->possibleVendorName.'%')->get();
    }
    public function render()
    {
        return view('livewire.vendor-list');
    }
}
