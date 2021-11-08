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
     * @param        $vendor
     * @param        $data
     * @param        $poVendorCode
     * @param        $itemVendorCode
     * @param        $poNumber
     * @param string $type
     *
     * @return \Illuminate\Support\Collection
     */

    protected function processCollection(
        $vendor,
        $data,
        $poVendorCode,
        $itemVendorCode,
        $poNumber,
        string $type = 'pos'
    ): \Illuminate\Support\Collection {
        $collection = [];
        foreach ($data as $sheet) {
            foreach ($sheet as $row) {
                if ($this->rowCheck($vendor, $row)) {
                    switch ($type) {
                        case 'shopify':
                            $collection[] = (object)$this->buildShopifyArrayFromRow($vendor, $row, $poVendorCode,
                                $itemVendorCode, $poNumber);
                            break;
                        default:
                            $collection[] = (object)$this->buildArrayFromRow($vendor, $row, $poVendorCode,
                                $itemVendorCode, $poNumber);
                    }
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
                return ( ! empty($row['upc_code']) && ! empty($row['style']) && ! empty($row['style_name']) && ! empty($row['price']));
            case 'Outdoor Research' :
                return ( ! empty($row['upc']) && ! empty($row['short_description']) && ! empty($row['style_name']) && ! empty($row['us_msrp']));
            case 'Kuhl' :
                return ( ! empty($row['upc']) && ! empty($row['style']) && ! empty($row['style_description']) && ! empty($row['msrp']));
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
            'OrderQty'      => $orderQty
        ];
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
    protected function buildShopifyArrayFromRow($vendor, $row, $poVendorCode, $itemVendorCode, $poNumber): array
    {
        $orderDate         = Carbon::now()->format('m/d/y');
        $shipDate          = Carbon::now()->format('m/d/y');
        $cancelDate        = Carbon::now()->format('m/d/y');
        $billToStore       = '0';
        $shipToStore       = '0';
        $cost              = '0';
        $taxable           = 'taxable';
        $orderQty          = '0';
        $conversions       = $this->conversionBuilder($vendor);
        $variantWeightUnit = 'g';
        $status            = 'active';

        return [
            'Handle'                                    => trim(($row[$conversions['UPC']]) ?? ''),
            'Title'                                     => trim(($row[$conversions['Description1']]) ?? ''),
            'Body (HTML)'                               => trim(($row[$conversions['Description2']]) ?? ''),
            'Vendor'                                    => '',
            'Type'                                      => '',
            'Tags'                                      => '',
            'Published'                                 => $shipDate,
            'Option1 Name'                              => 'size',
            'Option1 Value'                             => trim(($row[$conversions['Size']]) ?? ''),
            'Option2 Name'                              => 'color',
            'Option2 Value'                             => trim(($row[$conversions['Attr']]) ?? ''),
            'Option3 Name'                              => '',
            'Option3 Value'                             => '',
            'Variant SKU'                               => trim(($row[$conversions['UPC']]) ?? ''),
            'Variant Grams'                             => '',
            'Variant Inventory Tracker'                 => '',
            'Variant Inventory Qty'                     => $orderQty,
            'Variant Inventory Policy'                  => '',
            'Variant Fulfillment Service'               => '',
            'Variant Price'                             => $billToStore,
            'Variant Compare At Price'                  => '',
            'Variant Requires Shipping'                 => '',
            'Variant Taxable'                           => '',
            'Variant Barcode'                           => trim(($row[$conversions['SKU']]) ?? ''),
            'Image Src'                                 => '',
            'Image Position'                            => '',
            'Image Alt Text'                            => '',
            'Gift Card'                                 => '',
            'SEO Title'                                 => '',
            'SEO Description'                           => '',
            'Google Shopping / Google Product Category' => '',
            'Google Shopping / Gender'                  => '',
            'Google Shopping / Age Group'               => '',
            'Google Shopping / MPN'                     => '',
            'Google Shopping / AdWords Grouping'        => '',
            'Google Shopping / AdWords Labels'          => '',
            'Google Shopping / Condition'               => '',
            'Google Shopping / Custom Product'          => '',
            'Google Shopping / Custom Label 0'          => '',
            'Google Shopping / Custom Label 1'          => '',
            'Google Shopping / Custom Label 2'          => '',
            'Google Shopping / Custom Label 3'          => '',
            'Google Shopping / Custom Label 4'          => '',
            'Variant Image'                             => '',
            'Variant Weight Unit'                       => $variantWeightUnit,
            'Variant Tax Code'                          => '',
            'Cost per item'                             => trim(($row[$conversions['Retail']]) ?? ''),
            'Status'                                    => $status
        ];
    }


    protected function convertString($original)
    {
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
