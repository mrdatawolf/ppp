<?php namespace App\Http\Traits;

use App\Exports\POSExport;
use App\Imports\VendorImport;
use App\Models\ColorConversion;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

trait fileProcessor
{
    /**
     * @param $vendor
     * @param $inputFile
     * @param $poVendorCode
     * @param $itemVendorCode
     * @param $poNumber
     *
     * @return array
     */
    protected function processImport($vendor, $inputFile, $poVendorCode, $itemVendorCode, $poNumber): array
    {
        $importCollections = $this->convertFile($inputFile);
        $arrays            = $this->processArray($vendor, $importCollections, $poVendorCode, $itemVendorCode,
            $poNumber);

        return $arrays;
    }


    /**
     * @param $vendor
     * @param $importCollections
     * @param $poVendorCode
     * @param $itemVendorCode
     * @param $poNumber
     *
     * @return array
     */
    protected function processArray($vendor, $importCollections, $poVendorCode, $itemVendorCode, $poNumber): array
    {
        $arrays = [];
        foreach ($importCollections as $collections) {
            foreach ($collections as $row) {
                $arrays[] = $this->buildArrayFromRow($vendor, $row, $poVendorCode, $itemVendorCode, $poNumber);
            }
        }

        return $arrays;
    }


    /**
     * @param $vendor
     * @param $importArray
     * @param $poVendorCode
     * @param $itemVendorCode
     * @param $poNumber
     *
     * @return \Illuminate\Support\Collection
     */
    protected function processCollection($vendor, $importArray, $poVendorCode, $itemVendorCode, $poNumber): \Illuminate\Support\Collection
    {
        $collection = [];
        foreach ($importArray as $sheet) {
            foreach ($sheet as $row) {
                if($this->rowCheck($vendor,$row)) {
                    $collection[] = (object)$this->buildArrayFromRow($vendor, $row, $poVendorCode, $itemVendorCode,
                        $poNumber);
                }
            }
        }

        return collect($collection);
    }


    /**
     * @param $vendor
     * @param $row
     *
     * @return bool
     */
    protected function rowCheck($vendor, $row): bool
    {
        switch ($vendor) {
            case 'Jansport' :
                return (!empty($row['upc_code']) && !empty($row['style']) && !empty($row['style_name']) && !empty($row['price']));
            case 'Outdoor Research' :
                return (!empty($row['upc']) && !empty($row['short_description']) && !empty($row['style_name']) && !empty($row['us_msrp']));
            case 'Kuhl' :
                return (!empty($row['upc']) && !empty($row['style']) && !empty($row['style_description']) && !empty($row['msrp']));
        }

        return false;
    }


    /**
     * @param $inputFile
     *
     * @return array
     */
    protected function convertFile($inputFile): array
    {
        return Excel::toArray(new VendorImport, $inputFile);
    }


    /**
     * @param $import
     *
     * @return \App\Exports\POSExport
     */
    protected function buildExport($import): POSExport
    {
        return new POSExport($import);
    }


    protected function createExport($import)
    {
        $export = $this->buildExport($import);
        Excel::store($export, $this->exportFile);
    }


    /**
     * @param $vendor
     * @param $row
     * @param $poVendorCode
     * @param $itemVendorCode
     * @param $poNumber
     *
     * @return array
     */
    protected function buildArrayFromRow($vendor, $row, $poVendorCode, $itemVendorCode, $poNumber): array
    {
        $orderDate   = Carbon::now()->format('m/d/y');
        $shipDate    = Carbon::now()->format('m/d/y');
        $cancelDate  = Carbon::now()->format('m/d/y');
        $billToStore = '0';
        $shipToStore = '0';
        $dcs         = '';
        $cost        = '0';
        $taxable     = 'taxable';
        $orderQty    = '0';
        $conversions = $this->conversionBuilder($vendor);

        return [
            'PONumber'       => $poNumber,
            'OrderDate'      => $orderDate,
            'ShipDate'       => $shipDate,
            'CancelDate'     => $cancelDate,
            'BillToStore'    => $billToStore,
            'ShiptoStore'    => $shipToStore,
            'UPC'            => trim(($row[$conversions['UPC']]) ?? ''),
            'DCS'            => $dcs,
            'POVendorCode'   => $poVendorCode,
            'ItemVendorCode' => $itemVendorCode,
            'Description2'   => trim(($row[$conversions['Description2']]) ?? ''),
            'Attr'           => $this->convertString(trim(($row[$conversions['Attr']]) ?? '')),
            'Size'           => trim(($row[$conversions['Size']]) ?? ''),
            'Description1'   => trim(($row[$conversions['Description1']]) ?? ''),
            'Cost'           => $cost,
            'Retail'         => trim(($row[$conversions['Retail']]) ?? ''),
            'Taxable'        => $taxable,
            'Order Qty'      => $orderQty
        ];
    }


    protected function convertString($original) {
        $conversion = ColorConversion::where('original', $original);

        return ($conversion->exists()) ? $conversion->first()->convert_to : $original;
    }


    /**
     * @param $vendor
     *
     * @return array|string[]
     */
    protected function conversionBuilder($vendor): array
    {
        $conversions = [];
        switch ($vendor) {
            case 'Jansport' :
                $conversions = [
                    'UPC'          => 'upc_code',
                    'Description2' => 'style',
                    'Attr'         => 'color',
                    'Size'         => 'size',
                    'Description1' => 'style_name',
                    'Retail'       => 'price',
                ];
                break;
            case 'Outdoor Research' :
                $conversions = [
                    'UPC'          => 'upc',
                    'Description2' => 'short_description',
                    'Attr'         => 'color_family',
                    'Size'         => 'size',
                    'Description1' => 'style_name',
                    'Retail'       => 'us_msrp',
                ];
                break;
            case 'Kuhl' :
                $conversions = [
                    'UPC'          => 'upc',
                    'Description2' => 'style',
                    'Attr'         => 'color',
                    'Size'         => 'size_scale',
                    'Description1' => 'style_description',
                    'Retail'       => 'msrp',
                ];
                break;
        }

        return $conversions;
    }
}
