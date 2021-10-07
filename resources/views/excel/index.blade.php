<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Vendor File - Export POS and Shopify files') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container" style="margin-top: 5rem;">
                    @if($message = Session::get('success'))
                        <div class="alert alert-info alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Success!</strong> {{ $message }}
                        </div>
                    @endif
                    @livewire('pick-vendor')
                    {!! Session::forget('success') !!}
                    <br>
                    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <h4>Fields left blank will use defaults!</h4>
                        @livewire('po-number-input')

                        <input type="text" placeholder="Bill To Store" id="billToStore" name="billToStore">
                        <input type="text" placeholder="Ship To Store" id="shipToStore" name="shipToStore">
                        <input type="text" placeholder="DCS" id="dcs" name="dcs">
                        <input type="text" placeholder="PO Vendor Code" id="poVendorCode" name="poVendorCode">
                        <input type="text" placeholder="Item Vendor Code" id="itemVendorCode" name="itemVendorCode">
                        <input type="text" placeholder="Base Cost" id="baseCost" name="baseCost">
                        <br>
                        <label for="orderDate">Order Date: </label><input type="date" id="orderDate">
                        <label for="shipDate">Ship Date: </label><input type="date" id="shipDate">
                        <label for="cancelDate">Cancel Date: </label><input type="date" id="cancelDate">
                        <br><hr>
                        <input type="file" name="import_file" class="w-half">
                        <button class="w-half inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-200 text-base font-medium text-white hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Import File</button>
                    </form>
                    <a href="{{ route('exportExcel', 'csv') }}"><button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Download POS CSV</button></a>
                    <a href="{{ route('exportExcel', 'csv') }}"><button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Download Shopify CSV</button></a>
                </div>
                <div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

