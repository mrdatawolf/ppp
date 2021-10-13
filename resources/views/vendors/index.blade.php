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
                                <a class="btn btn-success w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm" href="{{ route('vendors.create') }}"> Create Vendor</a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table class="table table-bordered table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-2 text-xs text-gray-500">ID #</th>
                                <th class="px-6 py-2 text-xs text-gray-500">Name</th>
                                <th class="px-6 py-2 text-xs text-gray-500">PO Vendor Code</th>
                                <th class="px-6 py-2 text-xs text-gray-500">Item Vendor Code</th>
                                <th class="px-6 py-2 text-xs text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($vendors as $vendor)
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-2 text-sm text-gray-500">{{ $vendor->id }}</td>
                                    <td class="px-6 py-2 text-sm text-gray-500">{{ $vendor->name }}</td>
                                    <td class="px-6 py-2 text-sm text-gray-500">{{ $vendor->po_vendor_code }}</td>
                                    <td class="px-6 py-2 text-sm text-gray-500">{{ $vendor->item_vendor_code }}</td>
                                    <td class="px-6 py-2 text-sm text-gray-500">
                                        <form action="{{ route('vendors.destroy',$vendor->id) }}" method="Post">
                                            <a class="btn btn-primary w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-yellow-600 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:ml-3 sm:w-auto sm:text-sm" href="{{ route('vendors.edit',$vendor->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $vendors->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
