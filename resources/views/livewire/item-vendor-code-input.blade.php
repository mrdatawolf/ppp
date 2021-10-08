<div>
    <label for="itemVendorCode">Item Vendor Code </label><input wire:model="itemVendorCode" type="text" id="itemVendorCode" name="itemVendorCode">
    <br><span class="material-icons @if( !empty($vendorId) ) text-white @else text-red-600 @endif">arrow_upward</span>
    <span class="@if( !empty($vendorId) ) text-white @else text-red-600 @endif">Select a vendor to have the Item Vendor Code be filled in.</span>
</div>
