<div>
    @if($currentPage === 1)
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-gray-800">Search For Travels</h5>
        </div>

            <div class="card-body">
                    
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
                        
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-4">
                            <div class="btn-group shadow btn-group-toggle">
                                <label class="btn @if($class_type == 1)custom active @else btn-light @endif">
                                <input type="radio" wire:click="class_type(1)"> One Way
                                </label>
                                <label class="btn @if($class_type == 2)custom active @else btn-light @endif">
                                <input type="radio" wire:click="class_type(2)"> Return
                                </label>
                            </div>
                        </div>
                        <div class="col-4">

                        </div>
                        <div class="col-4">
                        <div class="dropdown">
                            <button class="btn btn-dark float-right dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Currency ({{$SelectedCurrency}})
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @forelse($currencies as $currency)
                                    <a type="button" wire:click="changeRate({{$currency->id}})" class="dropdown-item">{{$currency->name}}</a>
                                @empty
                                <a class="dropdown-item">No Currency</a>
                                @endforelse
                              
                            </div>
                        </div>
                        </div>
                    </div>
                    <hr>
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
                            <label for="return_departure_date">Return Date</label>
                                <input type="text" id="return_departure_date" @if($class_type != 2) disabled @endif
                                class="form-control datetimepicker" placeholder="Return Date"
                                wire:model="return_departure_date">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        
                        
                            <div class="col-3">
                                <h5>Adult</h5>
                                <button class="btn btn-danger" @if($travelerCount[0] >= $travelerCount[2] && $travelerCount[0] <= 0) disabled @endif  wire:click="sub(1)"><i class="fas fa-minus"></i></button>
                                <input type="submit" class="btn btn-light" disabled value="{{$travelerCount[0]}}" />
                                <button class="btn btn-success" wire:click="add(1)"><i class="fas fa-plus"></i></button>
                            </div>

                            <div class="col-3">
                                <h5>Child</h5>
                                <button class="btn btn-danger" @if($travelerCount[1] <= 0) disabled @endif  wire:click="sub(2)"><i class="fas fa-minus"></i></button>
                                <input type="submit" class="btn btn-light" disabled value="{{$travelerCount[1]}}" />
                                <button class="btn btn-success" wire:click="add(2)"><i class="fas fa-plus"></i></button>
                            </div>

                            <div class="col-3">
                                <h5>Infint</h5>
                                <button class="btn btn-danger" @if($travelerCount[2] <= 0) disabled @endif  wire:click="sub(3)"><i class="fas fa-minus"></i></button>
                                <input type="submit" class="btn btn-light" disabled value="{{$travelerCount[2]}}" />
                                <button class="btn btn-success" @if($travelerCount[2] >= $travelerCount[0]) disabled @endif wire:click="add(3)"><i class="fas fa-plus"></i></button>
                            </div>
                    </div>
                    <hr>
                    <div style="opacity:@if($class_type != 2) 0 @else 1 @endif;">
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
                    <button class="btn btn-block btn-info" wire:click="searching">Search</button>
               
            </div>
    </div>

    @if(!is_null($search))
   
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    
                </div>
                <div class="card-body">
                    @forelse($search as $value)
                    
                    @if($value->prices != null)
                                     
                        <div class="card price-table mt-2 w-full
                            border-left-primary
                         @if($value->prices->price_category->name == 'Economy')
                            border-left-primary
                        @elseif($value->prices->price_category->name == 'Bussiness')
                            border-left-info
                        @else   
                            border-left-success
                        @endif">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 price-table mb-3">
                                        <span class="badge badge-pill
                                            @if($value->prices->price_category->name == 'Economy')
                                                badge-primary
                                            @elseif($value->prices->price_category->name == 'Bussiness')
                                                badge-info
                                            @else   
                                                badge-success
                                            @endif">
                                            {{ $value->prices->price_category->name}}
                                        </span>
                                        <span class="badge badge-pill
                                            @if($value->prices->price_category->name == 'Economy')
                                                badge-primary
                                            @elseif($value->prices->price_category->name == 'Bussiness')
                                                badge-info
                                            @else   
                                                badge-success
                                            @endif">{{ $value->prices->name}} Class</span>
                                    </div>
                                    <div class="col-12 price-table">
                                        <div class="col-2 price-table">
                                            <h6>
                                                <strong>
                                                Departure {{date('d.m.Y',strtotime($value->departure_date))}}
                                            </strong>
                                            
                                        </h6>
                                        </div>
                                        <div class="col-2 price-table">
                                            <h6>
                                                <strong class="float-right">
                                                Arrival {{date('d.m.Y',strtotime($value->arrival_date))}}
                                            </strong>
                                        </h6>
                                        </div>
                                        @foreach($value->prices->prices as $price)
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
                                                
                                                <h6 class="destination">{{$value->destination->from->IATA}}</h6>
                                                @if(isset($value->stopover))
                                                <h6 class="destination">{{$value->stopover->IATA}}</h6>
                                                @endif
                                                <h6 class="destination">{{$value->destination->to->IATA}}</h6>
    
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
                                                    {{date('H.i',strtotime($value->departure_time))}}
                                                </h6>
                                                @if(isset($value->stopover))
                                                <div>
                                                    
                                                <h6 class="destination text-center">{{date('H.i',strtotime($value->stopover_arrival_datetime))}} -
                                                    {{date('H.i',strtotime($value->stopover_departure_datetime))}}</h6>
                                                
                                                <h6 class="destination">{{date('d.m.Y',strtotime($value->stopover_arrival_datetime))}}</h6>
                                                </div>
                                                @endif
                                                <h6 class="destination"> {{date('H.i',strtotime($value->arrival_time))}}</h6>
    
                                            </div>
                                            <div class="price-card d-flex justify-content-center">
                                                <h6>Duration({{date('H', strtotime($value->duration)).'h'}} 
                                                    {{date('i', strtotime($value->duration)).'m'}})</h6>
    
                                            </div>
                                        </div>
                                        @foreach($value->prices->prices as $key => $price)
                                        
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
                                                
                                                @if($value->prices->return != null)
                                                {{ (($price->price + $price->more_price) * $value->prices->currency->rate->rate) + 
                                                ($value->destination->from->taxes[$key]->tax * $value->destination->from->taxes[$key]->currency->rate->rate) +
                                                ($value->prices->return->from->taxes[$key]->tax * $value->prices->return->from->taxes[$key]->currency->rate->rate)}} 

                                                {{ $value->prices->currency->rate->to->currency_code }}
                                                @else
                                                {{ (($price->price + $price->more_price) * $value->prices->currency->rate->rate) + 
                                                    ($value->destination->from->taxes[$key]->tax * $value->destination->from->taxes[$key]->currency->rate->rate)
                                                }}
                                                {{ $value->prices->currency->rate->to->currency_code }}
                                                @endif
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal End Here -->
                                        @endforeach
                                        
                                        <div class="col-2 price-table">
                                            <ul class="ml-3">
                                                @foreach($value->prices->prices as $key => $price) 
                                                @if($value->prices->return != null)
                                                    @php
                                                    $travelerTotal[$key] = $travelerCount[$key] * ((($price->price + $price->more_price) * $value->prices->currency->rate->rate) + 
                                                    ($value->destination->from->taxes[$key]->tax * $value->destination->from->taxes[$key]->currency->rate->rate) +
                                                    ($value->prices->return->from->taxes[$key]->tax * $value->prices->return->from->taxes[$key]->currency->rate->rate));
                                                    @endphp
                                                @else
                                                    @php
                                                    $travelerTotal[$key] = $travelerCount[$key] * ((($price->price + $price->more_price) * $value->prices->currency->rate->rate) + 
                                                    ($value->destination->from->taxes[$key]->tax * $value->destination->from->taxes[$key]->currency->rate->rate));
                                                    @endphp
                                                @endif
                                                <li>
                                                    {{ $travelerCount[$key] }}x{{ $price->traveler_type->name}} - {{$travelerTotal[$key]}}
                                                    
                                                    
                                                </li>
                                                @endforeach
                                                
                                                @if($value->prices->return != null)
                                                @php
                                                    $travelerPrice[$key] = (($price->price + $price->more_price) * $value->prices->currency->rate->rate) + 
                                                    ($value->destination->from->taxes[$key]->tax * $value->destination->from->taxes[$key]->currency->rate->rate) +
                                                    ($value->prices->return->from->taxes[$key]->tax * $value->prices->return->from->taxes[$key]->currency->rate->rate);
                                                @endphp
                                                @else
                                                @php
                                                    $travelerPrice[$key] = (($price->price + $price->more_price) * $value->prices->currency->rate->rate) + 
                                                    ($value->destination->from->taxes[$key]->tax * $value->destination->from->taxes[$key]->currency->rate->rate);
                                                @endphp
                                                @endif
                                                </i></li>
                                                <li> <strong> Total {{ array_sum($travelerTotal)}} {{ $value->prices->currency->rate->to->currency_code }}</strong></li>
                                            </ul>
                                            @php
                                            if(!is_null($value->prices->return_id))
                                            {
                                                $return_id = $value->prices->return->travel->id;
                                            }
                                            else{
                                                $return_id = 0;     
                                            }
                                                 

                                            @endphp
                                                <button @if(auth()->user()->bank->balance < array_sum($travelerTotal)) disabled 
                                                    title="Your Balance its too low." 
                                                    @endif 
                                                    wire:click="startBooking({{$value->id}},{{$value->prices->id}},{{$return_id}},{{ array_sum($travelerTotal)}})" class="mt-2 btn custom btn-block">Start Booking</button>
                                                    
                                        </div>
                                    </div>

                                    <!-- for return -->
                                    
                                    @if(isset($value->prices->return->travel))
                               
                                    <div class="col-2 price-table">
                                        <h6>
                                            <strong>
                                                
                                            Return {{date('d.m.Y',strtotime($value->prices->return->travel->departure_date))}}
                                        </strong>
                                    </h6>
                                    </div>
                                    <div class="col-2 price-table">
                                        <h6>
                                            <strong class="float-right">
                                            Arrival {{date('d.m.Y',strtotime($value->prices->return->travel->arrival_date))}}
                                        </strong>
                                    </h6>
                                    </div>
                                </div>
                                <div class="col-12 price-table">
                                    <div class="col-4 price-table">
                                        <div class="price-card d-flex justify-content-between">
                                            
                                            <h6 class="destination">{{$value->prices->return->travel->destination->from->IATA}}</h6>
                                           
                                            @if(isset($value->prices->return->travel->stopover))
                                            <h6 class="destination">{{$value->prices->return->travel->stopover->IATA}}</h6>
                                            @endif
                                            <h6 class="destination">{{$value->prices->return->travel->destination->to->IATA}}</h6>

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
                                                {{date('H.i',strtotime($value->prices->return->travel->departure_time))}}
                                            </h6>

                                            @if(isset($value->prices->return->travel->stopover))
                                            <div>
                                            
                                            <h6 class="destination text-center">{{date('H.i',strtotime($value->prices->return->travel->stopover_arrival_datetime))}} -
                                                {{date('H.i',strtotime($value->prices->return->travel->stopover_departure_datetime))}}</h6>
                                            
                                            <h6 class="destination">{{date('d.m.Y',strtotime($value->prices->return->travel->stopover_arrival_datetime))}}</h6>
                                            </div>
                                            @endif

                                            <h6 class="destination"> {{date('H.i',strtotime($value->prices->return->travel->arrival_time))}}</h6>

                                        </div>
                                        <div class="price-card d-flex justify-content-center">
                                            <h6>Duration({{date('H', strtotime($value->prices->return->travel->duration)).'h'}} 
                                                {{date('i', strtotime($value->prices->return->travel->duration)).'m'}})</h6>

                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                       
                    @empty
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">No Travels this date, on this destination. Try again.</h4>
                            </div>
                        </div>
                    @endforelse    
           
                </div>  
            </div>
        </div>
    </div>
    @endif
    @elseif($currentPage === 2)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-gray-800">Main Contact Information</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-2">
                    <label for="phonecode">Phone Code</label>
                    <select class="form-control @error('phonecode') border border-danger @enderror" wire:model="phonecode" id="phonecode">
                        <option>Choose Phone Code</option>
                        @foreach($phone_codes as $phone_code) 
                        <option value="{{$phone_code->dial_code}}">{{$phone_code->name}} ({{$phone_code->dial_code}})</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control  @error('phone') border border-danger @enderror" id="phone" wire:model="phone" placeholder="Phone Number">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-5">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') border border-danger @enderror" id="email" wire:model="email" placeholder="Your@email.com">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-5">
                    <button @if(is_null($phone) || is_null($phonecode) || is_null($email))
                     disabled
                    @endif
                     class="btn btn-success" wire:click="confirmContact">Save Contact</button>
                </div>
            </div>
        </div>
    </div>
    @elseif($currentPage === 3)
    @foreach($travelers as $traveler)
        @if($travelerCount[$loop->index] > 0)
            @for($x = 1; $x <= $travelerCount[$loop->index];$x++)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{$x}}. {{$traveler->name}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-1">
                               
                                <label for="gender">Gender</label>
                                <select wire:model="gender.{{$x}}.{{$traveler->name}}" id="gender" class="form-control 
                                    @error('gender.'.$x.'.'.$traveler->name) border border-danger @enderror">
                                    <option selected>Choose</option>
                                    @foreach($genders as $key => $gender)
                                        <option value="{{$gender}}">{{$key}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="first">First Name</label>
                                <input type="text" wire:model="first.{{$x}}.{{$traveler->name}}" id="first" placeholder="First Name" 
                                class="form-control @error('first.'.$x.'.'.$traveler->name) border border-danger @enderror">
                                
                            </div>
                            <div class="col-4">
                                <label for="last">Last Name</label>
                                <input type="text" wire:model="last.{{$x}}.{{$traveler->name}}" id="last" placeholder="Last Name" 
                                class="form-control @error('last.'.$x.'.'.$traveler->name) border border-danger @enderror">
                            </div>

                            <div class="col-3">
                                <label for="bday">Birthday <i>(YYYY-MM-DD)</i>
                                    <span class="text-danger">
                                        @if($errors->has('bday.'.$x.'.'.$traveler->name))  
                                            {{ $errors->first('bday.'.$x.'.'.$traveler->name)}}
                                        @endif  
                                    </span>
                                </label>
                                <input type="text" id="bday"  wire:model.lazy="bday.{{$x}}.{{$traveler->name}}" placeholder="Birthday (YYYY-MM-DD)"
                                 class="form-control @error('bday.'.$x.'.'.$traveler->name) border border-danger @enderror">
                            </div>
                        </div>
                        <hr>
                            
                        <div class="form-group row">
                        <div class="col-2">
                            <label for="phonecode">Passport Nationality</label>
                            <select class="form-control @error('passport_nation.'.$x.'.'.$traveler->name) border border-danger @enderror" 
                                wire:model="passport_nation.{{$x}}.{{$traveler->name}}">
                                <option>Choose Passport Nationality</option>
                                @foreach($countries as $contry) 
                                {{$countries}}
                                <option value="{{$contry->Iso3}}">{{$contry->name}} ({{$contry->Iso3}})</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="passport">Passport Number</label>
                            <input type="text" class="form-control @error('passport_number.'.$x.'.'.$traveler->name) border border-danger @enderror"
                            wire:model="passport_number.{{$x}}.{{$traveler->name}}" placeholder="Passport Number">
                        </div>
                        <div class="col-3">
                            <label for="departure_date">Date of Expiry <i>(YYYY-MM-DD)</i></label>
                            <input type="text"  
                            class="form-control expiry @error('expiry.'.$x.'.'.$traveler->name) border border-danger @enderror" 
                            placeholder="Date"
                            wire:model="expiry.{{$x}}.{{$traveler->name}}">
                        </div>

                        <div class="col-3">
                            <label for="phonecode">Nationality</label>
                            <select class="form-control" wire:model="nation.{{$x}}.{{$traveler->name}}">
                                <option>Choose Nationality</option>
                                @foreach($countries as $contry) 
                                <option value="{{$contry->code}}">{{$contry->name}} ({{$contry->code}})</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-3">
                                @if($traveler->id === 3)
                                @if(isset($first[$x]['Adult']) && isset($last[1]['Adult']))
                                <input type="text" class="form-control" value="{{$first[$x]['Adult']}} {{$last[$x]['Adult']}}" disabled />
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        @endif
    @endforeach
    <div class="card shadow">   
        <div class="card-body">
            <button class="btn btn-success" wire:click="confirm">Continue</button>
        </div>
    </div>

    @elseif($currentPage === 4)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Confirm</h6>
        </div>
        <div class="card-body">
            <div class="col-4 d-block mx-auto">
               <strong>Balance</strong> {{auth()->user()->bank->balance}} {{$SelectedCode}}
               <br>
               <strong>payments</strong> {{$total}} {{$SelectedCode}}
               <hr>
                New Balance {{auth()->user()->bank->balance - $total}} {{$SelectedCode}}
                <br>
                <button class="btn btn-success" wire:click="payment">Confirm</button>            
            </div>
        </div>
    </div>
    @endif
</div>
