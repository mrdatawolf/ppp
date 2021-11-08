<?php

namespace App\Http\Livewire;

use App\Exports\ShopifyCollectionExport;
use App\Http\Traits\fileProcessor;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DownloadShopify extends Component
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
        $this->data    = $this->processCollection($vendorName, $data, $poVendorCode, $itemVendorCode, $poNumber,'shopify');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function shopifyDownload(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $col = [];
        foreach ($this->data as $d) {
            $col[] = (object)$d;
        }
        $collection    = collect($col);
        $shopifyExport = new ShopifyCollectionExport($collection);

        return Excel::download($shopifyExport, 'shopifyExport.csv', \Maatwebsite\Excel\Excel::CSV);
    }


    public function render()
    {
        return view('livewire.download-shopify');
    }
}
