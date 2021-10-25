<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class CancelDateInput extends Component
{
    public string $cancelDate;
    public bool   $shouldDisplay;

    public $listeners = ['vendorChanged'];
    protected $casts = ['vendor' => 'collection'];


    public function mount()
    {
        $this->cancelDate    = Carbon::now()->format('Y-m-d');
        $this->shouldDisplay = false;
    }


    public function vendorChanged($vendor)
    {
        $this->shouldDisplay = ! empty($vendor['name']);
    }


    public function render()
    {
        return view('livewire.cancel-date-input');
    }
}
