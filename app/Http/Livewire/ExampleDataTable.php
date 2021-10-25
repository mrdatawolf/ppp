<?php

namespace App\Http\Livewire;

use App\Exports\POSCollectionExport;
use App\Exports\ShopifyCollectionExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ExampleDataTable extends Component
{
    public bool  $hasData;
    public array $data;
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


    public function importProcessed($data)
    {
        $this->hasData = ( ! empty($data));
        $this->data    = $data;
    }


    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function posDownload(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $col=[];
        foreach($this->data as $d) {
            $col[] = (object) $d;
        }
        $collection = collect($col);
        $posExport = new POSCollectionExport($collection);

        return Excel::download($posExport,'posExport.csv',\Maatwebsite\Excel\Excel::CSV);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function shopifyDownload(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $col=[];
        foreach($this->data as $d) {
            $col[] = (object) $d;
        }
        $collection = collect($col);
        $posExport = new ShopifyCollectionExport($collection);

        return Excel::download($posExport,'shopifyExport.csv',\Maatwebsite\Excel\Excel::CSV);
    }


    public function render()
    {
        return view('livewire.example-data-table');
    }
}
