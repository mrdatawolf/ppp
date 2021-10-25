<div>
    <div class="max-w-sm rounded overflow-hidden shadow-lg">
        <p class="p-4">Vendors</p>
        <div class="border-b-2 m-0"></div>
        <p class="p-4">Select Vendor: </p>
        <div class="mr-8 ml-4">
            <div class="relative">
                <button wire:emit="flipVendorList" wire:click="flipListIcon" class="bg-ppp-green p-3 rounded text-white shadow-inner w-full">
                    <label for="vendorString"><span class="float-left">Show vendors</span></label>
                    <span class="material-icons-outlined ppp-brown">@if($showExpandedList) expand_more @else chevron_right @endif</span>
                </button>
                <div class="rounded shadow-md my-2 relative pin-t pin-l">
                    <input wire:model="vendorName" id="vendorString" class="border-2 rounded h-8 w-full">
                    @livewire('vendor-list')
                </div>
            </div>
        </div>
    </div>
</div>
