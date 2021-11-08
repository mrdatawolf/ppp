<?php

namespace App\Http\Livewire;

use App\Http\Traits\fileProcessor;
use Livewire\Component;

class ExampleDataTable extends Component
{
    use fileProcessor;

    public bool  $hasData;
    public       $data;
    public bool  $shouldDisplay;

    public $listeners = ['importProcessed', 'vendorChanged'];
    protected $casts = ['vendor' => 'collection'];


    public function mount()
    {
        $this->hasData       = false;
        $this->shouldDisplay = false;
        $this->data          = [];
    }


    public function vendorChanged($vendor)
    {
        $this->shouldDisplay = ! empty($vendor['name']);
    }


    /**
     * @param $vendorName
     * @param $data
     * @param $poVendorCode
     * @param $itemVendorCode
     * @param $poNumber
     */
    public function importProcessed($vendorName, $data, $poVendorCode, $itemVendorCode, $poNumber)
    {
        $this->hasData = ( ! empty($data));
        $this->data    = $this->processCollection($vendorName, $data, $poVendorCode, $itemVendorCode, $poNumber);
    }


    public function render()
    {
        return view('livewire.example-data-table');
    }
}
