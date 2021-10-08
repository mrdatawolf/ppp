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
                        @livewire('po-vendor-code-input')
                        @livewire('item-vendor-code-input')
                        <br>
                        @livewire('order-date-input')
                        @livewire('ship-date-input')
                        @livewire('cancel-date-input')

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

