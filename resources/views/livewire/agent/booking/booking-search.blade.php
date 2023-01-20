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
                    <select name="" id="">
                        
                    </select>
                    <div class="form-group row">
                        
                        <div class="col-4">
                            
                            <label for="">From</label>
                                <input type="text" class="form-control" wire:model="departure" placeholder="Select Departure">

                                @if($departure != $addedDeparture)
                                <div class="container table-price-tableed">    
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
                                <div class="container table-price-tableed">    
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
                                    <div class="container table-price-tableed">    
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
                                    <div class="container table-price-tableed">    
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
    @if(!is_null($values))
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Created Destinations</h6>
                </div>
                <div class="card-body">
                    @forelse($values as $value)
                        <div class="card price-table mt-2 w-full
                            border-left-primary
                         @if($value->price_category->name == 'Economy')
                            border-left-primary
                        @elseif($value->price_category->name == 'Bussiness')
                            border-left-info
                        @else   
                            border-left-success
                        @endif">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 price-table mb-3">
                                        <span class="badge badge-pill
                                            @if($value->price_category->name == 'Economy')
                                                badge-primary
                                            @elseif($value->price_category->name == 'Bussiness')
                                                badge-info
                                            @else   
                                                badge-success
                                            @endif">
                                            {{ $value->price_category->name}}
                                        </span>
                                        <span class="badge badge-pill
                                            @if($value->price_category->name == 'Economy')
                                                badge-primary
                                            @elseif($value->price_category->name == 'Bussiness')
                                                badge-info
                                            @else   
                                                badge-success
                                            @endif">{{ $value->name}} Class</span>
                                    </div>
                                    <div class="col-12 price-table">
                                        <div class="col-2 price-table">
                                            <h6>
                                                <strong>
                                                Departure {{date('d.m.Y',strtotime($value->destination->travel->departure_date))}}
                                            </strong>
                                        </h6>
                                        </div>
                                        <div class="col-2 price-table">
                                            <h6>
                                                <strong class="float-right">
                                                Arrival {{date('d.m.Y',strtotime($value->destination->travel->arrival_date))}}
                                            </strong>
                                        </h6>
                                        </div>
                                        @foreach($value->prices as $price)
                                        <div class="col-2 price-table text-center">
                                            <h6>{{$price->traveler_type->name}}</h6>
                                        </div>
                                        @endforeach
                                        <div class="col-2 price-table text-center">
                                            <h6>Total</h6>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 price-table">
                                        <div class="col-4 price-table">
                                            <div class="price-card d-flex justify-content-between">
                                                <h6 class="destination">{{$value->destination->travel->destination->from->IATA}}</h6>
                                                
                                                <h6 class="destination">{{$value->destination->travel->stopover->IATA}}</h6>
                                                
                                                <h6 class="destination">{{$value->destination->travel->destination->to->IATA}}</h6>
    
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="circle"></div>
                                                    <div class="line"></div>
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="circle"></div>
                                                    <div class="line"></div>
                                                    <div class="circle"></div>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="price-card d-flex justify-content-between">
                                                <h6 class="destination">
                                                    {{date('H.i',strtotime($value->destination->travel->departure_time))}}
                                                </h6>
                                                <div>
                                                <h6 class="destination text-center">{{date('H.i',strtotime($value->destination->travel->stopover_arrival_datetime))}} -
                                                    {{date('H.i',strtotime($value->destination->travel->stopover_departure_datetime))}}</h6>
                                                
                                                <h6 class="destination">{{date('d.m.Y',strtotime($value->destination->travel->stopover_arrival_datetime))}}</h6>
                                                </div>
                                                <h6 class="destination"> {{date('H.i',strtotime($value->destination->travel->arrival_time))}}</h6>
    
                                            </div>
                                            <div class="price-card d-flex justify-content-center">
                                                <h6>Duration({{date('H', strtotime($value->destination->travel->duration)).'h'}} 
                                                    {{date('i', strtotime($value->destination->travel->duration)).'m'}})</h6>
    
                                            </div>
                                        </div>
                                        @foreach($value->prices as $price)
                                        <div class="col-2 price-table">
                                            <ul class="ml-3">  
                                                <li>{{$price->luggage }} kg Luggage</li>
                                                <li>{{$price->hand_luggage }} Hand Luggage</li>
                                                @if($value->refundable == 0)
                                                <li>Refundable <i class="fas fa-times"></i></li>
                                                @else
                                                <li>Refundable <i class="fas fa-check"></i></li>
                                                @endif
                                                @if($value->change_able == 0)
                                                <li>ChangeAble <i class="fas fa-times"></i></li>
                                                @else
                                                <li>ChangeAble <i class="fas fa-check"></i></li>
                                                @endif
                                                <li>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#Modal{{$price->id}}">Rules
                                                        <i class="fas fa-info-circle">
                                                        </i>
                                                    </button> 
                                                </li>
                                            </ul>
                                            <div class="row">
                                            <strong class="w-100 text-center">
                                                
                                                Price @if($value->currency->from->name == 'DKK') 
                                                {{ $price->price }}
                                                @elseif($price->tax->currency->from->name == 'DKK')
                                                {{ $price->price * $value->currency->from->rate + $price->tax->tax }}
                                                @else
                                                {{($price->price * $value->currency->from->rate) + ($price->tax->tax * $value->currency->from->rate)}}
                                                @endif
                                                {{ $value->currency->to->rate}}
                                            </strong>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{$price->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Rules</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        {{$price->rule}}
                                                    </p>
                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close X</button>
                                                        <button type="sumbmit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal End Here -->
                                        @endforeach

                                        <div class="col-2 price-table">
                                            <ul class="ml-3">  
                                                <li>3 x Adult - <i>10500 DKK</i></li>
                                                <li>1 x Child - 1750  DKK</li>
                                                <li>2 x Infint - 2500 DKK</li>
                                                <li>Total - 2500 DKK</li>
                                            </ul>
                                            <button class="mt-2 btn custom btn-block" href="">Start Booking</button>
                                        </div>
                                    </div>

                                    <!-- for return -->
                                    
                                    @if(isset($value->return->travel))
                               
                                    <div class="col-2 price-table">
                                        <h6>
                                            <strong>
                                                
                                            Return {{date('d.m.Y',strtotime($value->return->travel->departure_date))}}
                                        </strong>
                                    </h6>
                                    </div>
                                    <div class="col-2 price-table">
                                        <h6>
                                            <strong class="float-right">
                                            Arrival {{date('d.m.Y',strtotime($value->return->travel->arrival_date))}}
                                        </strong>
                                    </h6>
                                    </div>
                                </div>
                                <div class="col-12 price-table">
                                    <div class="col-4 price-table">
                                        <div class="price-card d-flex justify-content-between">
                                            <h6 class="destination">{{$value->return->travel->destination->from->IATA}}</h6>
                                            
                                            @if(isset($value->return->travel->stopover))
                                            <h6 class="destination">{{$value->return->travel->stopover->IATA}}</h6>
                                            @endif
                                            <h6 class="destination">{{$value->return->travel->destination->to->IATA}}</h6>

                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="circle"></div>
                                                <div class="line"></div>
                                                <div class="circle"></div>
                                            </div>
                                            <div class="col-6">
                                                <div class="circle"></div>
                                                <div class="line"></div>
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="price-card d-flex justify-content-between">
                                            <h6 class="destination">
                                                {{date('H.i',strtotime($value->return->travel->departure_time))}}
                                            </h6>

                                            @if(isset($value->return->travel->stopover))
                                            <div>
                                            
                                            <h6 class="destination text-center">{{date('H.i',strtotime($value->return->travel->stopover_arrival_datetime))}} -
                                                {{date('H.i',strtotime($value->return->travel->stopover_departure_datetime))}}</h6>
                                            
                                            <h6 class="destination">{{date('d.m.Y',strtotime($value->return->travel->stopover_arrival_datetime))}}</h6>
                                            </div>
                                            @endif

                                            <h6 class="destination"> {{date('H.i',strtotime($value->return->travel->arrival_time))}}</h6>

                                        </div>
                                        <div class="price-card d-flex justify-content-center">
                                            <h6>Duration({{date('H', strtotime($value->return->travel->duration)).'h'}} 
                                                {{date('i', strtotime($value->return->travel->duration)).'m'}})</h6>

                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                       
                    @empty

                    @endforelse    
           
                </div>  
            </div>
        </div>
    </div>
    @endif
</div>
