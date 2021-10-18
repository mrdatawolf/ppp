<div>
    <label for="vendor">Vendor</label>
        <select wire:model="vendor" id="vendor" name="vendor" class="form-control border" required autofocus>
            @foreach ($vendors as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    <span class="material-icons @if( !empty($vendor)) text-white @else text-red-600 @endif">arrow_left</span>
</div>
