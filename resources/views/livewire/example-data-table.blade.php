<div class="@if(! $shouldDisplay) hidden @endif">
    @if($hasData)
        <a href="{{ route('exportExcel', 'csv') }}"><button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Download POS CSV</button></a>
        <a href="{{ route('exportExcel', 'csv') }}"><button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Download Shopify CSV</button></a>
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
            @foreach($data as $array)
                <tr class="whitespace-nowrap">
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['PONumber'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['OrderDate'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['ShipDate'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['CancelDate'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['BillToStore'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['ShiptoStore'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['UPC'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['DCS'] }}</td>
                    <td class="px-2 py-1 text-sm text-gray-500">{{ $array['POVendorCode'] }}</td>
                    <td class="px-2 py-1 text-sm text-gray-500">{{ $array['ItemVendorCode'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['Description2'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['Attr'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['Size'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['Description1'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['Cost'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['Retail'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['Taxable'] }}</td>
                    <td class="px-4 py-1 text-sm text-gray-500">{{ $array['Order Qty'] }}</td>
                </tr>
            @endforeach
        </table>
    @else
        No data to display!
    @endif
</div>
