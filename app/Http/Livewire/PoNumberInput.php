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
        $this->poNumber = Carbon::now()->format('mdy');
    }

    public function vendorChanged($name) {
        $this->vendorName = $name;
    }



    public function render()
    {
        return view('livewire.po-number-input');
    }
}
