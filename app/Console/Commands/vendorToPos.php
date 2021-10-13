<?php

namespace App\Console\Commands;

use App\Http\Traits\fileProcessor;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Console\Command;

class vendorToPos extends Command
{
    use fileProcessor;

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
                                {poNumber : specify a po number to use}
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
        $this->vendor    = Vendor::where('name', $this->argument('vendor'))->first();
        $this->inputFile = strtolower($this->argument('inputFile'));

        $this->makePoNumber();
        $this->makeFilename();

        $import = $this->processImport($this->vendor->name, $this->inputFile, $this->vendor->po_vendor_code, $this->vendor->item_vendor_code, $this->poNumber);
        $this->createExport($import);

        $this->output->text('Finished making '.$this->exportFile.' for '.$this->vendor->name.'!');

        return 0;
    }



    protected function makePoNumber()
    {
        $poNumber       = $this->argument('poNumber');
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
}
