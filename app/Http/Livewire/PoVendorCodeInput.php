<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class PoVendorCodeInput extends Component
{
    public int    $vendorId;
    public string $poVendorCode;
    public bool   $shouldDisplay;

    protected $listeners = ['vendorChanged'];


    public function mount()
    {
        $this->shouldDisplay = false;
    }


    public function vendorChanged($name)
    {
        $this->shouldDisplay = ! empty($name);
        $vendor              = Vendor::where('name', $name)->first();
        $this->vendorId      = $vendor->id;
        $this->poVendorCode  = $vendor->po_vendor_code;
        $this->emit('poVendorCodeChanged', $this->poVendorCode);
    }


    public function render()
    {
        return view('livewire.po-vendor-code-input');
    }
}
