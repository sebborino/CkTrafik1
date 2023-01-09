<div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table</h6>
        </div>
            <div class="card-body">
                    @csrf
                    @if($errors->any())
                        @foreach($errors->all() as $error)

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>OPS!</strong>  {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endforeach
                    @elseif(Session::has('message'))
            
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">Well done!</h4>
                        <p>{!! Session::get('message') !!}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>   
                    @endif

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="h3 mb-0 text-gray-800">Search For Departures</h2>
                    </div>

                    <div class="form-group row">
                        <div class="col-4">
                            <div class="btn-group shadow btn-group-toggle">
                                <label class="btn @if($class_type == 1)custom active @else btn-light @endif">
                                <input type="radio" wire:model="class_type" value="1"> One Way
                                </label>
                                <label class="btn @if($class_type == 2)custom active @else btn-light @endif">
                                <input type="radio" wire:model="class_type" value="2"> Return
                                </label>
                            </div>
                        </div>
                    </div>

                    {{ $class_type}}
                    <div class="form-group row">
                        
                        <div class="col-4">
                            
                            <label for="">From</label>
                                <input type="text" class="form-control" wire:model="departure" placeholder="Select Departure">

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
                                <input type="text" class="form-control" wire:model="arrival" placeholder="Select Arrival">

                                @if($arrival != $addedArrival)
                                <div class="container table-bordered">    
                                    @forelse($arrivals as $arrival)
                                        <button wire:click="addArrival({{$arrival->id}},'{{$arrival->IATA}} ({{$arrival->name}})')" class="dropdown-item">{{$arrival->IATA}} ({{$arrival->name}})</button>
                                    @empty

                                    @endforelse
                                </div>
                                @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-2">
                            <label for="departure_date">Date</label>
                                <input type="text"  
                                class="form-control datetimepicker" placeholder="Date"
                                wire:model="departure_date">
                        </div>

                        <div class="col-2" style="opacity: @if($class_type == 2) 1 @else 0  @endif ;">
                            <label for="return_departure_date">Dates</label>
                                <input type="text" id="return_departure_date"
                                class="form-control datetimepicker" placeholder="Return Date"
                                wire:model="return_departure_date">
                        </div>
                    </div>
                    
                    
                    <hr>
                    <div  style="opacity:@if($class_type != 2) 0 @else 1 @endif;">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h2 class="h3 mb-0 text-gray-800">Return</h2>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="">From</label>
                                    <input type="text" class="form-control" wire:model="ReturnDeparture">

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
                                    <input type="text" class="form-control" wire:model="ReturnArrival">

                                    @if($ReturnArrival != $ReturnAddedArrival)
                                    <div class="container table-bordered">    
                                        @forelse($ReturnArrivals as $ReturnArrival)
                                            <button wire:click="ReturnAddArrival({{$ReturnArrival->id}},'{{$ReturnArrival->IATA}} ({{$ReturnArrival->name}})')" class="dropdown-item">{{$ReturnArrival->IATA}} ({{$ReturnArrival->name}})</button>
                                        @empty

                                        @endforelse
                                    </div>
                                    @endif
                            </div>
                            
                        </div>
                    </div>
                    <button class="btn btn-block btn-info" wire:click="search">Search</button>
            </div>
    </div>



    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Created Destinations</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Destinations</th>
                                    <th>Class</th>
                                    <th>Edit</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            @if(!is_null($values))
                               @forelse($values as $value) 
                                <tr>
                                    <td>{{$value->destination->from->IATA}} - {{$value->destination->to->IATA}}</td>
                                    <td>{{$value->name }}</td>
                                    <td>
                                        <ul>
                                            @foreach($value->traveler_types as $type)
                                                <li>{{ $type->name }}</li>
                                            @endforeach    
                                        </ul>
                                    </td>
                                </tr>
                                @empty
                                

                                @endforelse
                            @endif
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>