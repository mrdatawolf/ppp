<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Vendor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left mb-2">
                            <h2>Add Vendor</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary btn btn-success w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm" href="{{ route('vendors.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
                @if(session('status'))
                    <div class="alert alert-success mb-1 mt-1">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('vendors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="name"><strong>Name:</strong></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                                @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="po_vendor_code"><strong>PO Vendor Code:</strong></label>
                                <input type="text" id="po_vendor_code" name="po_vendor_code" class="form-control" placeholder="PO Vendor Code">
                                @error('po_vendor_code')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="item_vendor_code"><strong>Item Vendor Code:</strong></label>
                                <input type="text" id="item_vendor_code" name="item_vendor_code" class="form-control" placeholder="Item Vendor Code">
                                @error('item_vendor_code')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ml-3btn btn-success w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
