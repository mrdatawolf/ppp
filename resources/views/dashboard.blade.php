<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mt-2">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Welcome</h2>
                            </div>
                            <div class="pull-right mb-2">
                                <a href="{{ route('importExportView') }}" class="ppp-color"><span class="material-icons-outlined">filter_alt</span> Import</a> takes you to the main purpose of the site. Converting a vendor's CSV file into a format POS and/or Shopify can process.
                            </div>
                            <div class="pull-right mb-2">
                                <a href="{{ route('vendors.index') }}" class="ppp-color"><span class="material-icons-outlined">business</span> Vendors</a> lets you add/edit vendor info.
                            </div>
                            <div class="pull-right mb-2">
                                <a href="{{ route('colors.index') }}" class="ppp-color"><span class="material-icons-outlined">palette</span> Colors</a> lets you add/edit color conversion info. You give it a unique string of words and it will convert them to your common color naming scheme.
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
