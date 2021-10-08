<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class CancelDateInput extends Component
{
    public string $cancelDate;

    public function mount() {
        $this->cancelDate = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.cancel-date-input');
    }
}
