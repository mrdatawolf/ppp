<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class PoNumberInput extends Component
{
    public $poNumber;
    public $vendorName;

    protected $listeners = ['vendorChanged'];
    public function mount() {
        $this->setPoNumber();
    }

    private function setPoNumber() {
        $this->poNumber = (empty($this->vendorName)) ? 'Pick a Vendor' : Carbon::now()->format('m/d/y').strtoupper(substr($this->vendorName, 0, 2));
    }

    public function vendorChanged($name) {
        $this->vendorName = $name;
        $this->setPoNumber();
    }



    public function render()
    {
        return view('livewire.po-number-input');
    }
}
