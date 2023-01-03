<div class="col-12">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table</h6>
        </div>
            <div class="card-body">
                <div class="row">
                    <div class="container-fluid">
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
                    
                    @elseif(Session::has('update'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">Well done!</h4>
                        <p>{!! Session::get('update') !!}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    @endif
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="h3 mb-0 text-gray-800">Flight Details</h2>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Flight(Route)</label>
                            <select class="form-control" wire:model="SelectFlight" wire:change="changeFlight">
                                <option value="">Choose Route</option>  
                                @forelse($flights as $flight)
                                    <option value="{{$flight->id}}">{{$flight->route}} ({{$flight->airline->name}})</option>
                                @empty
                                    No Routes
                                @endforelse        
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Destination(Route)</label>
                            <select class="form-control" {{ empty($SelectFlight) ? 'disabled' : '' }} wire:model="SelectedDestination">
                                <option value="0">Choose Destination</option>  
                                @forelse($destinations as $destination)
                                    <option value="{{$destination->id}}">{{$destination->from->IATA}}-{{$destination->to->IATA}} ({{$destination->flight->route}})</option>
                                @empty
                                    No Destinations
                                @endforelse        
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Categories</label>
                            <select class="form-control" {{ empty($SelectedDestination) ? 'disabled' : '' }} wire:model="SelectedSesson">
                                <option value="0">Choose Sesson</option>  
                                @forelse($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}
                                    </option>
                                @empty
                                    No Sessons
                                @endforelse        
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="h3 mb-0 text-gray-800">Flight Class Details</h2>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="class">Class Name</label>
                            <input id="class" class="form-control" 
                            {{ empty($SelectedSesson) ? 'disabled' : '' }}
                             type="text" wire:model="class"
                             placeholder="Class Name" />
                        </div>

                        <div class="col-md-3">
                            <label>Class Type</label>
                            <select class="form-control" {{ empty($class) ? 'disabled' : '' }} wire:model="class_type_code">
                                <option value="0">Choose Sesson</option>  
                                @forelse($classtypes as $classtype)
                                    <option value="{{$classtype->id}}">({{$classtype->class_type_code}}) {{$classtype->name}} 
                                    </option>
                                @empty
                                    No Sessons
                                @endforelse        
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Traveler Type</label>
                            <select class="form-control" {{ empty($class) ? 'disabled' : '' }} wire:model="traveler_type">
                                <option value="0">Choose Sesson</option>  
                                @forelse($travelerTypes as $travelerType)
                                    <option value="{{$travelerType->id}}">{{$travelerType->name}} 
                                    </option>
                                @empty
                                    No Traveler Types
                                @endforelse        
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="h3 mb-0 text-gray-800">Price Details</h2>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="currency">Currency</label>
                            <select id="currency" class="form-control" {{ empty($class_type_code) ? 'disabled' : '' }} wire:model="SelectedCurrency">
                                <option value="0">Choose Currency</option>  
                                @forelse($currencies as $currency)
                                    <option value="{{$currency->id}}">{{$currency->currency_code}}
                                    </option>
                                @empty
                                    No Sessons
                                @endforelse        
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="price">Price</label>
                            <input type="number" class="form-control"
                            {{ empty($SelectedCurrency) ? 'disabled' : '' }}
                             wire:model="price" />
                        </div>

                        <div class="col-md-1">
                            <label for="tax_price">Tax</label>
                            <input type="number" class="form-control"
                            {{ empty($price) ? 'disabled' : '' }}
                             wire:model="tax_price" />
                        </div>

                        <div class="col-md-1">
                            <label for="more_price">More Price</label>
                            <input type="number" class="form-control"
                            {{ empty($price) ? 'disabled' : '' }}
                             wire:model="more_price" />
                        </div>
                        
                    </div>    

                    <button type="submit" wire:click="save"
                    {{ empty($price) ? 'disabled' : '' }}     
                    class="btn custom btn-user btn-block">
                        Create Flight Class
                    </button>
                </div>
            </div>
            </div>
        </div>
    </div>