<?php

namespace App\Http\Livewire;

use App\Exports\POSCollectionExport;
use App\Http\Traits\fileProcessor;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DownloadPos extends Component
{
    use fileProcessor;

    public bool  $hasData;
    public       $data;
    public bool  $shouldDisplay;

    public $listeners = ['importProcessed', 'vendorChanged'];

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

    public function importProcessed($vendorName, $data, $poVendorCode, $itemVendorCode, $poNumber)
    {
        $this->hasData = ( ! empty($data));
        $this->data    = $this->processCollection($vendorName, $data, $poVendorCode, $itemVendorCode, $poNumber);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function posDownload(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $col = [];
        foreach ($this->data as $d) {
            $col[] = (object)$d;
        }
        $collection = collect($col);
        $posExport  = new POSCollectionExport($collection);

        return Excel::download($posExport, 'posExport.csv', \Maatwebsite\Excel\Excel::CSV);
    }


    public function render()
    {
        return view('livewire.download-pos');
    }
}
