<?php

namespace App\Http\Livewire;

use App\Imports\VendorImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportButton extends Component
{
    use WithFileUploads;


    public        $vendor;
    public        $inputFile;
    public string $poVendorCode;
    public string $itemVendorCode;
    public string $poNumber;
    public bool   $shouldDisplay;
    public bool   $fileReady;

    public $listeners = ['poNumberChanged', 'vendorChanged', 'poVendorCodeChanged', 'itemVendorCodeChanged'];
    protected $casts = ['vendor' => 'collection'];


    public function mount()
    {
        $this->vendor         = collect([]);
        $this->poNumber       = '';
        $this->itemVendorCode = '';
        $this->poVendorCode   = '';
        $this->inputFile      = null;
        $this->shouldDisplay  = false;
        $this->fileReady      = false;
    }


    public function vendorChanged($vendor)
    {
        $this->vendor        = $vendor;
        $this->shouldDisplay = ! empty($vendor['name']);
        $this->checkFileReady();
    }


    public function poVendorCodeChanged($code)
    {
        $this->poVendorCode = $code;
        $this->checkFileReady();
    }


    public function itemVendorCodeChanged($code)
    {
        $this->itemVendorCode = $code;
        $this->checkFileReady();
    }


    public function poNumberChanged($number)
    {
        $this->poNumber = $number;
        $this->checkFileReady();
    }


    public function updatedInputFile()
    {
        $this->checkFileReady();
    }

    public function checkFileReady() {
        $this->fileReady = ( ! empty($this->inputFile) && ! empty($this->poNumber) && strlen($this->poNumber) == 8);
        if($this->fileReady) {
            $this->processFile();
        }
    }


    public function processFile()
    {
        ini_set('memory_limit','768M');
        $importer = new VendorImport($this->vendor['name']);
        $data = Excel::toArray($importer, $this->inputFile);
        $this->emit('importProcessed', $this->vendor['name'], $data, $this->poVendorCode, $this->itemVendorCode, $this->poNumber);
    }


    public function render()
    {
        return view('livewire.import-button');
    }
}
