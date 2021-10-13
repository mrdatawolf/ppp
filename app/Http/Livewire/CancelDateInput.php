<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class CancelDateInput extends Component
{
    public string $cancelDate;
    public bool   $shouldDisplay;

    protected $listeners = ['vendorChanged'];


    public function mount()
    {
        $this->cancelDate    = Carbon::now()->format('Y-m-d');
        $this->shouldDisplay = false;
    }


    public function vendorChanged($name)
    {
        $this->shouldDisplay = ! empty($name);
    }


    public function render()
    {
        return view('livewire.cancel-date-input');
    }
}
