<div>
    <label for="poVendorCode">PO Vendor
        Code </label><input wire:model="poVendorCode" type="text" id="poVendorCode" name="poVendorCode">
    <br><span class="material-icons @if( !empty($vendorId) ) text-white @else text-red-600 @endif">arrow_upward</span>
    <span class="@if( !empty($vendorId) ) text-white @else text-red-600 @endif">Select a vendor to have the PO Vendor Code be filled in.</span>
</div>
