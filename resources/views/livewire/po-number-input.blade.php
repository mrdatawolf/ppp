<div>
    <label for="poNumber">PO Number </label><input wire:model="poNumber" type="text" id="poNumber" name="poNumber">
    <span class="material-icons @if(! empty($vendorName)) text-white @else text-red-600 @endif">arrow_upward</span>
</div>
