<?php

namespace App\Http\Livewire;

use App\Http\Traits\fileProcessor;
use App\Imports\VendorImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportButton extends Component
{
    use WithFileUploads;
    use fileProcessor;

    public string $vendor;
    public        $data;
    public        $inputFile;
    public string $poVendorCode;
    public string $itemVendorCode;
    public string $poNumber;
    public bool   $shouldDisplay;
    public bool   $fileReady;

    protected $listeners = ['poNumberChanged', 'vendorChanged', 'poVendorCodeChanged', 'itemVendorCodeChanged'];


    public function mount()
    {
        $this->vendor         = '';
        $this->data           = collect((object)[]);
        $this->poNumber       = '';
        $this->itemVendorCode = '';
        $this->poVendorCode   = '';
        $this->inputFile      = null;
        $this->shouldDisplay  = false;
        $this->fileReady      = false;
    }


    public function vendorChanged($name)
    {
        $this->vendor        = $name;
        $this->shouldDisplay = ! empty($name);
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
        $importer = new VendorImport($this->vendor);
        $data       = Excel::toArray($importer, $this->inputFile);
        $this->data = $this->processCollection($this->vendor, $data, $this->poVendorCode, $this->itemVendorCode, $this->poNumber);
        $this->emit('importProcessed', $this->data);
    }


    public function render()
    {
        return view('livewire.import-button');
    }
}
