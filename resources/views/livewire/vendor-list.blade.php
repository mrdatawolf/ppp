<div>
    <ul class="list-reset @if(! $showExpandedList)  hidden @endif">
        @foreach ($vendors as $vendor)
            <li wire:click="$set('possibleVendorName','{{ $vendor['name'] }}')"><p class="p-2 block text-black hover:bg-grey-light cursor-pointer">{{ $vendor['name'] }} @if(!empty($possibleVendorName) && $vendor['name'] === $possibleVendorName) <span class="material-icons-outlined ppp-brown pull-right">check</span>@endif</p></li>
        @endforeach
    </ul>
</div>
