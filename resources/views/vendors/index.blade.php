<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mt-2">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Vendor</h2>
                            </div>
                            <div class="pull-right mb-2">
                                <a class="btn btn-success" href="{{ route('vendors.create') }}"> Create Vendor</a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>ID #</th>
                            <th>PO Vendor Code</th>
                            <th>Item Vendor Code</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($vendors as $vendor)
                            <tr>
                                <td>{{ $vendor->id }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->po_vendor_code }}</td>
                                <td>{{ $vendor->item_vendor_code }}</td>
                                <td>
                                    <form action="{{ route('vendors.destroy',$vendor->id) }}" method="Post">
                                        <a class="btn btn-primary" href="{{ route('vendors.edit',$vendor->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $vendors->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
