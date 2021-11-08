<div class="@if(! $shouldDisplay) hidden @endif">
    @if($hasData)
        <table class="table table-bordered table-auto">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-1 text-xs text-gray-500">PONumber</th>
                <th class="px-4 py-1 text-xs text-gray-500">OrderDate</th>
                <th class="px-4 py-1 text-xs text-gray-500">ShipDate</th>
                <th class="px-4 py-1 text-xs text-gray-500">CancelDate</th>
                <th class="px-2 py-1 text-xs text-gray-500">BillTo</th>
                <th class="px-2 py-1 text-xs text-gray-500">Shipto</th>
                <th class="px-4 py-1 text-xs text-gray-500">UPC</th>
                <th class="px-4 py-1 text-xs text-gray-500">DCS</th>
                <th class="px-4 py-1 text-xs text-gray-500">POVCode</th>
                <th class="px-4 py-1 text-xs text-gray-500">ItemVCode</th>
                <th class="px-4 py-1 text-xs text-gray-500">Description2</th>
                <th class="px-4 py-1 text-xs text-gray-500">Attr</th>
                <th class="px-4 py-1 text-xs text-gray-500">Size</th>
                <th class="px-4 py-1 text-xs text-gray-500">Description1</th>
                <th class="px-4 py-1 text-xs text-gray-500">Cost</th>
                <th class="px-4 py-1 text-xs text-gray-500">Retail</th>
                <th class="px-4 py-1 text-xs text-gray-500">Taxable</th>
                <th class="px-4 py-1 text-xs text-gray-500">Order Qty</th>
            </tr>
            </thead>
            @foreach($data as $row)
                <tr class="whitespace-nowrap">
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->PONumber }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->OrderDate }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->ShipDate }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->CancelDate }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->BillToStore }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->ShiptoStore }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->UPC }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->DCS }}</td>
                    <td class="px-2 py-1 text-sm text-gray-500">{{ $row->POVendorCode }}</td>
                    <td class="px-2 py-1 text-sm text-gray-500">{{ $row->ItemVendorCode }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->Description2 }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->Attr }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->Size }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->Description1 }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->Cost }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->Retail }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->Taxable }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $row->OrderQty }}</td>
                </tr>
            @endforeach
        </table>
    @else
        No data to display!
    @endif
</div>
