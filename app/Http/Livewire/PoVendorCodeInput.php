<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Illuminate\Support\Collection;
use Livewire\Component;

class PoVendorCodeInput extends Component
{
    public    $vendor;
    public string $poVendorCode;
    public bool   $shouldDisplay;

    public $listeners = ['vendorChanged'];
    protected $casts = ['vendor' => 'collection'];


    public function mount()
    {
        $this->vendor = collect([]);
        $this->shouldDisplay = false;
    }


    public function vendorChanged($vendor)
    {
        $this->shouldDisplay = ! empty($vendor['name']);
        $this->vendor      = $vendor;
        if(! empty($vendor['po_vendor_code'])) {
            $this->poVendorCode = $vendor['po_vendor_code'];
            $this->emit('poVendorCodeChanged', $this->poVendorCode);
        }
    }


    public function render()
    {
        return view('livewire.po-vendor-code-input');
    }
}
