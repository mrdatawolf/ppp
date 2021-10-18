<div class="@if(! $shouldDisplay) hidden @endif">
    <input wire:model="inputFile" type="file" name="import_file" class="w-half" >
    <span class="@if(! $fileReady) hidden @endif">
    <button wire:click="checkFileReady" class="w-half inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-200 text-base font-medium text-white hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Import File</button>
    </span>
</div>
