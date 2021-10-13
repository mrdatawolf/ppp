@php ini_set('memory_limit','768M'); @endphp
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
                    @livewire('po-number-input')
                    {!! Session::forget('success') !!}
                    <br>
                    @livewire('po-vendor-code-input')
                    @livewire('item-vendor-code-input')
                    <br>
                    @livewire('order-date-input')
                    @livewire('ship-date-input')
                    @livewire('cancel-date-input')
                    <br><hr>
                    @livewire('import-button')
                </div>
                @livewire('example-data-table')
            </div>
        </div>
    </div>
</x-app-layout>

