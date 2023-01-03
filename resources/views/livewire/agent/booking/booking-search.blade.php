<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h3 mb-0 text-gray-800">Search For Departures</h2>
    </div>
    <div class="form-group row">
        
        <div class="col-4">
            
            <label for="">From</label>
                <input type="text" class="form-control" wire:model="departure">

                @if($departure != $addedDeparture)
                <div class="container table-bordered">    
                    @forelse($departures as $departure)
                        <button wire:click="addDeparture({{$departure->id}},'{{$departure->IATA}} ({{$departure->name}})')" class="dropdown-item">{{$departure->IATA}} ({{$departure->name}})</button>
                    @empty

                    @endforelse
                </div>
                @endif
        </div>
        <div class="col-4">
            
            <label for="">To</label>
                <input type="text" class="form-control" wire:model="arrival">

                @if($arrival != $addedArrival)
                <div class="container table-bordered">    
                    @forelse($arrivals as $arrival)
                        <button wire:click="addArrival({{$arrival->id}},'{{$arrival->IATA}} ({{$arrival->name}})')" class="dropdown-item">{{$arrival->IATA}} ({{$arrival->name}})</button>
                    @empty

                    @endforelse
                </div>
                @endif
        </div>
        <div class="col-2">
            <label for="departure_date">Date</label>
                <input type="text"  
                class="form-control datetimepicker" placeholder="Date"
                wire:model="departure_date">
        </div>
        <div class="col-2">
            <label for="travelType">One Way/Return</label>
            <select wire:model="class_type" class="form-control">
                @forelse($travelTypes as $travelType)
                    <option value="{{$travelType->id}}">{{$travelType->name}}</option>
                @empty    
                @endforelse
            </select>
        </div>
    </div>
    
    <hr>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h3 mb-0 text-gray-800">Return</h2>
    </div>
    <div class="form-group row">
        <div class="col-4">
            <label for="">From</label>
                <input type="text" class="form-control" wire:model="ReturnDeparture" @if($class_type != 2) disabled @endif>

                @if($ReturnDeparture != $ReturnAddedDeparture)
                <div class="container table-bordered">    
                    @forelse($ReturnDepartures as $ReturnDepartures)
                        <button wire:click="ReturnAddDeparture({{$ReturnDepartures->id}},'{{$ReturnDepartures->IATA}} ({{$ReturnDepartures->name}})')" class="dropdown-item">{{$ReturnDepartures->IATA}} ({{$ReturnDepartures->name}})</button>
                    @empty

                    @endforelse
                </div>
                @endif
        </div>
        <div class="col-4">
            
            <label for="">To</label>
                <input type="text" class="form-control" wire:model="ReturnArrival" @if($class_type != 2) disabled @endif>

                @if($ReturnArrival != $ReturnAddedArrival)
                <div class="container table-bordered">    
                    @forelse($ReturnArrivals as $ReturnArrival)
                        <button wire:click="ReturnAddArrival({{$ReturnArrival->id}},'{{$ReturnArrival->IATA}} ({{$ReturnArrival->name}})')" class="dropdown-item">{{$ReturnArrival->IATA}} ({{$ReturnArrival->name}})</button>
                    @empty

                    @endforelse
                </div>
                @endif
        </div>
        <div class="col-2">
            <label for="return_departure_date">Date</label>
                <input type="text" id="return_departure_date"
                class="form-control datetimepicker" placeholder="Return Date"
                wire:model="return_departure_date">
        </div>
    </div>
    <button class="btn btn-block btn-info" wire:click="search">Search</button>
</div>