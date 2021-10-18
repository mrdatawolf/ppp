<div class="@if(! $shouldDisplay) hidden @endif">
    <label for="poNumber">PO Number </label>
    <input class="border" wire:model="poNumber" type="text" id="poNumber" name="poNumber">
    <br><span class="material-icons @if( strlen($poNumber) == 8) ) text-white @else text-red-600 @endif">arrow_upward</span>
    <span class="@if( strlen($poNumber) == 8 ) text-white @else text-red-600 @endif">
        The PO Number should be 8 characters.  Normally the first 6 are the date and the last 2 are the purchaser.
    </span>
</div>
