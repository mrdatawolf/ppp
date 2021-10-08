<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class PoVendorCodeInput extends Component
{
    public int $vendorId;
    public string $poVendorCode;
    public $listeners = ['vendorChanged'];

    public function vendorChanged($name) {
        $vendor = Vendor::where('name',$name)->first();
        $this->vendorId = $vendor->id;
        $this->poVendorCode = $vendor->po_vendor_code;
    }

    public function render()
    {
        return view('livewire.po-vendor-code-input');
    }
}
