<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ShopifyCollectionExport implements FromCollection, WithHeadings
{
    protected Collection $imports;

    public function __construct($imports) {
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

    public function collection(): Collection
    {
        return $this->imports;
    }
}
