<div class="col-4">
            
    <label for="{{$name}}">{{$title}}</label>
        <input type="text" id="{{$name}}" class="form-control" wire:model="input">
        <input type="hidden" name="{{$name}}" value="{{$airportId}}" />
        @if($input != $addedInput)  
        <div class="container table-bordered">
                @forelse($values as $value)
                    <a wire:click="addAirport({{$value->id}},'{{$value->IATA}} ({{$value->name}})')" class="dropdown-item">{{$value->IATA}} ({{$value->name}})</a>
                @empty
            @endforelse 
        </div>
        @endif
</div>
