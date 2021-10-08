<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class ItemVendorCodeInput extends Component
{
    public int $vendorId;
    public string $itemVendorCode;
    public $listeners = ['vendorChanged'];

    public function vendorChanged($name) {
        $vendor = Vendor::where('name',$name)->first();
        $this->vendorId = $vendor->id;
        $this->itemVendorCode = $vendor->item_vendor_code;
    }

    public function render()
    {
        return view('livewire.item-vendor-code-input');
    }
}
