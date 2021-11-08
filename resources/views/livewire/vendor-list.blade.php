<ul class="list-reset">
    @foreach ($vendors as $vendor)
        <li wire:click="vendorClicked('{{ $vendor['name'] }}')"><p class="p-2 block text-black hover:bg-grey-light cursor-pointer">{{ $vendor['name'] }} @if(!empty($vendorClickedName) && $vendor['name'] === $vendorClickedName) <span class="material-icons-outlined ppp-brown pull-right">check</span>@endif</p></li>
    @endforeach
</ul>
