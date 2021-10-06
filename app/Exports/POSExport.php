<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class POSExport implements FromArray, WithHeadings
{
    protected $imports;

    public function __construct(array $imports) {
        $this->imports = $imports;
    }

    public function headings(): array
    {
        return [
            'PONumber',
            'OrderDate',
            'ShipDate',
            'CancelDate',
            'BillToStore',
            'ShiptoStore',
            'UPC',
            'DCS',
            'POVendorCode',
            'ItemVendorCode',
            'Description2',
            'Attr',
            'Size',
            'Description1',
            'Cost',
            'Retail',
            'Taxable',
            'Order Qty'
        ];
    }

    public function array(): array
    {
        return $this->imports;
    }
}
