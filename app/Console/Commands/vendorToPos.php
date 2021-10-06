<?php

namespace App\Console\Commands;

use App\Exports\POSExport;
use App\Imports\JansportImport;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class vendorToPos extends Command
{
    protected $vendor;
    protected $poNumber;
    protected $exportFile;
    protected $inputFile;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:vendorToPOS
                                {vendor}
                                {inputFile}
                                {--poNumber= : specify a po number to use}
                                {--saveAs= : give the name of the file to output}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converts the vendor file to a format the POS can use';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->vendor    = strtolower($this->argument('vendor'));
        $this->inputFile = strtolower($this->argument('inputFile'));

        $this->makePoNumber();
        $this->makeFilename();

        $arrays            = [];
        $importCollections = Excel::toArray(new JansportImport, $this->inputFile);
        foreach ($importCollections as $collections) {
            foreach ($collections as $row) {
                $arrays[] = $this->buildArrayFromRow($row);
            }
        }
        $export = new POSExport($arrays);
        Excel::store($export, $this->exportFile);
        $this->output->text('Finished making '.$this->exportFile.' for '.$this->vendor.'!');

        return 0;
    }


    protected function makePoNumber()
    {
        $poNumber       = $this->option('poNumber') ?? Carbon::now()->format('m/d/y').substr($this->vendor, 0, 2);
        $this->poNumber = strtolower($poNumber);
    }


    protected function makeFilename()
    {
        $fileName = $this->option('saveAs') ?? 'posexport'.Carbon::now()->format('m_d_Y').'.csv';
        if ( ! str_contains($fileName, '.csv')) {
            $fileName = $fileName.'.csv';
        }
        $this->exportFile = $fileName;
    }


    protected function buildArrayFromRow($row): array
    {
        $poNumber       = $this->poNumber;
        $orderDate      = Carbon::now()->format('m/d/y');
        $shipDate       = Carbon::now()->format('m/d/y');
        $cancelDate     = Carbon::now()->format('m/d/y');
        $billToStore    = '0';
        $shipToStore    = '0';
        $dcs            = 'CLOWN PAN';
        $poVendorCode   = $this->vendor;
        $itemVendorCode = $this->vendor;
        $cost           = '0';
        $taxable        = 'taxable';
        $orderQty       = '0';
        $conversions    = [
            'UPC'          => 'upc_code',
            'Description2' => 'style',
            'Attr'         => 'color',
            'Size'         => 'size',
            'Description1' => 'style_name',
            'Retail'       => 'price',
        ];

        return [
            'PONumber'       => $poNumber,
            'OrderDate'      => $orderDate,
            'ShipDate'       => $shipDate,
            'CancelDate'     => $cancelDate,
            'BillToStore'    => $billToStore,
            'ShiptoStore'    => $shipToStore,
            'UPC'            => trim($row[$conversions['UPC']]),
            'DCS'            => $dcs,
            'POVendorCode'   => $poVendorCode,
            'ItemVendorCode' => $itemVendorCode,
            'Description2'   => trim($row[$conversions['Description2']]),
            'Attr'           => trim($row[$conversions['Attr']]),
            'Size'           => trim($row[$conversions['Size']]),
            'Description1'   => trim($row[$conversions['Description1']]),
            'Cost'           => $cost,
            'Retail'         => trim($row[$conversions['Retail']]),
            'Taxable'        => $taxable,
            'Order Qty'      => $orderQty
        ];
    }
}
