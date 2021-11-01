<div class="{{ $visiblity }}">
    <ul class="list-reset">
        @foreach ($vendors as $vendor)
            <li wire:click="$set('vendorClickedName','{{ $vendor['name'] }}')"><p class="p-2 block text-black hover:bg-grey-light cursor-pointer">{{ $vendor['name'] }} @if(!empty($possibleVendorName) && $vendor['name'] === $possibleVendorName) <span class="material-icons-outlined ppp-brown pull-right">check</span>@endif</p></li>
        @endforeach
    </ul>
</div>
