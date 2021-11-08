<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Illuminate\Support\Collection;
use Livewire\Component;

class VendorList extends Component
{
    public Collection $vendors;
    public            $vendor;
    public string     $vendorClickedName;
    public            $listeners = ['vendorChanged', 'vendorSearchChanged'];
    protected array   $casts     = ['vendor' => 'collection', 'vendors' => 'collection'];


    public function mount()
    {
        $this->vendorClickedName = '';
        $this->getPossibleVendors();
    }


    public function vendorChanged($vendor)
    {
        $this->vendorClickedName = $vendor['name'];
        $this->vendor = $vendor;
    }


    public function vendorSearchChanged($name)
    {
        if ($name !== $this->vendorClickedName) {
            $this->vendorClickedName = $name;
            $this->getPossibleVendors();
        }
    }


    public function vendorClicked($name) {
        if($this->vendorClickedName !== $name) {
            $this->vendorClickedName = $name;
            $this->getPossibleVendors();
            $this->emit('vendorPicked', $name);

        }
    }


    protected function getPossibleVendors()
    {
        $getVendors = Vendor::select('id', 'name')->orderBy('name');
        $this->vendors = (empty($this->vendorClickedName)) ? $getVendors->where('name','safdfasdfae')->get()
            : $getVendors->where('name', 'like', '%'.$this->vendorClickedName.'%')->get();
    }


    public function render()
    {
        return view('livewire.vendor-list');
    }
}
