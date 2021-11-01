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
    public string     $visiblity;
    public            $listeners = ['vendorChanged', 'flipChevron', 'vendorSearchChanged'];
    protected array   $casts     = ['vendor' => 'collection', 'vendors' => 'collection'];
    protected bool    $isVisible;


    public function mount()
    {
        $this->vendorClickedName = '';
        $this->setVisiblity(false);
        $this->getPossibleVendors();
    }


    public function vendorChanged($vendor)
    {
        $this->vendor = $vendor;
    }


    public function vendorSearchChanged($name)
    {
        if ($name !== $this->vendorClickedName) {
            $this->vendorClickedName = $name;
            $this->getPossibleVendors();
            $this->setVisiblity();
        }
    }


    public function flipChevron($chevron)
    {
        $this->setVisiblity($chevron === "expand_more");
    }


    protected function getPossibleVendors()
    {
        $getVendors = Vendor::select('id', 'name')->orderBy('name');
        $this->vendors = (empty($this->vendorClickedName)) ? $getVendors->get()
            : $getVendors->where('name', 'like', '%'.$this->vendorClickedName.'%')->get();
    }


    protected function setVisiblity($force = null)
    {
        $this->isVisible = $force ?? ( ! empty($this->vendorClickedName)) || ! $this->isVisible;
        $this->visiblity = ($this->isVisible) ? 'visible' : 'invisible';
    }


    public function render()
    {
        return view('livewire.vendor-list');
    }
}
