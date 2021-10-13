<div class="@if(! $shouldDisplay) hidden @endif">
    @if($hasData)
        <a href="{{ route('exportExcel', 'csv') }}"><button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Download POS CSV</button></a>
        <a href="{{ route('exportExcel', 'csv') }}"><button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Download Shopify CSV</button></a>
        <table>
            <thead>
            <tr>
                <th>PONumber</th>
                <th>OrderDate</th>
                <th>ShipDate</th>
                <th>CancelDate</th>
                <th>BillToStore</th>
                <th>ShiptoStore</th>
                <th>UPC</th>
                <th>DCS</th>
                <th>POVendorCode</th>
                <th>ItemVendorCode</th>
                <th>Description2</th>
                <th>Attr</th>
                <th>Size</th>
                <th>Description1</th>
                <th>Cost</th>
                <th>Retail</th>
                <th>Taxable</th>
                <th>Order Qty</th>
            </tr>
            </thead>
            @foreach($data as $array)
                <tr>
                    <td>{{ $array['PONumber'] }}</td>
                    <td>{{ $array['OrderDate'] }}</td>
                    <td>{{ $array['ShipDate'] }}</td>
                    <td>{{ $array['CancelDate'] }}</td>
                    <td>{{ $array['BillToStore'] }}</td>
                    <td>{{ $array['ShiptoStore'] }}</td>
                    <td>{{ $array['UPC'] }}</td>
                    <td>{{ $array['DCS'] }}</td>
                    <td>{{ $array['POVendorCode'] }}</td>
                    <td>{{ $array['ItemVendorCode'] }}</td>
                    <td>{{ $array['Description2'] }}</td>
                    <td>{{ $array['Attr'] }}</td>
                    <td>{{ $array['Size'] }}</td>
                    <td>{{ $array['Description1'] }}</td>
                    <td>{{ $array['Cost'] }}</td>
                    <td>{{ $array['Retail'] }}</td>
                    <td>{{ $array['Taxable'] }}</td>
                    <td>{{ $array['Order Qty'] }}</td>
                </tr>
            @endforeach
        </table>
    @else
        No data to display!
    @endif
</div>
