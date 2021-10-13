<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class ItemVendorCodeInput extends Component
{
    public int    $vendorId;
    public string $itemVendorCode;
    public bool   $shouldDisplay;

    protected $listeners = ['vendorChanged'];


    public function mount()
    {
        $this->shouldDisplay = false;
    }


    public function vendorChanged($name)
    {
        $this->shouldDisplay = ! empty($name);
        $vendor               = Vendor::where('name', $name)->first();
        $this->vendorId       = $vendor->id;
        $this->itemVendorCode = $vendor->item_vendor_code;
        $this->emit('itemVendorCodeChanged', $this->itemVendorCode);
    }


    public function render()
    {
        return view('livewire.item-vendor-code-input');
    }
}
