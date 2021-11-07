<div>
    <div class="max-w-sm rounded overflow-hidden shadow-lg">
        <p class="p-4">Vendors</p>
        <div class="border-b-2 m-0"></div>
        <p class="p-4">Select Vendor: </p>
        <div class="mr-8 ml-4">
            <div class="relative">
                <div class="rounded shadow-md my-2 relative pin-t pin-l">
                    <input wire:model="vendorSearchName" id="vendorString" class="border-2 rounded h-8 w-full">
                    @livewire('vendor-list')
                </div>
            </div>
        </div>
    </div>
</div>
