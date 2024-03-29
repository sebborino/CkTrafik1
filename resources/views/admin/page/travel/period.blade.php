@extends('admin.layout.app')

@section('content')

@push('datepicker-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/datepicker/css/bootstrap.css" />
@endpush



        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Travel</h1>
        </div>
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">User</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">                               
                        <div class="p-5">
                            <div class="text-center">
                            </div>
                           
                            <form action="{{ route('admin.travel.period.create')}}" class="user" method="post">
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
                                    <h2 class="h3 mb-0 text-gray-800">Period</h2>
                                </div>
                                <div class="form-group row"> 
                                    <div class="col-sm-4 mb-4 mb-sm-0">
                                        <div class="input-group">
                                            <label for="period_from">Period From</label>
                                            <div class='input-group mt-1 datetimepicker'>
                                                <input type="text" id="period_from" name="period_from" class="form-control
                                                @error('period_from') border border-danger @enderror" value="{{ old('period_from')}}" placeholder="Period From">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-calendar"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 mb-4 mb-sm-0">
                                        <div class="input-group">
                                            <label for="period_to">Period To</label>
                                            <div class='input-group mt-1 datetimepicker'>
                                                <input type="text" id="period_to" name="period_to" value="" class="form-control
                                                @error('period_to') border border-danger @enderror" value="{{ old('period_to')}}" placeholder="Period To">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-calendar"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h2 class="h3 mb-0 text-gray-800">Travel Details</h2>
                                </div>
                                <div class="form-group row"> 
                                    <div class="col-sm-4 mb-4 mb-sm-0">
                                            <label for="destination_id">Destination</label>
                                            <select class="form-control" name="destination_id" id="destination_id">
                                                <option value="{{ old('destination_id')}}">Choose a Destination</option>    
                                                @forelse($destinations as $destination)
                                                    <option value="{{ $destination->id}}">{{ $destination->from->IATA}} - {{ $destination->to->IATA}}</option>   
                                                @empty

                                                @endforelse
                                            </select>      
                                        </div>
                                    
                                        <div class="col-sm-4 mb-4 mb-sm-0">
                                            <div class="form-group">
                                                <label for="departure_day">Departure Day</label>
                                                <select class="form-control" name="departure_day" id="departure_day">
                                                    <option value="{{ old('departure_day')}}">Choose a Day</option>    
                                                    @forelse($dayLabels as $key => $dayLabel)
                                                        <option value="{{ $key}}">{{ $dayLabel}}</option>   
                                                    @empty
    
                                                    @endforelse
                                                </select>      
                                            </div>
                                        </div>
                                    <div class="col-sm-4 mb-4 mb-sm-0">
                                        <div class="input-group">
                                            <label for="time">Departure Time</label>
                                            <div class='input-group mt-1 timepicker'>
                                                <input type='text' id="time" name="departure_time" class="form-control 
                                                @error('departure_time') border border-danger @enderror" value="{{ old('departure_time')}}" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-clock"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row"> 
                                    <div class="col-sm-4 mb-4 mb-sm-0">
                                        <div class="input-group">
                                            <label for="duration">Duration</label>
                                            <div class='input-group mt-1 timepicker'>
                                                <input type='text' id="duration" name="duration" class="form-control 
                                                @error('duration') border border-danger @enderror" value="{{ old('duration')}}" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-clock"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-4 mb-sm-0">
                                        <div class="form-group">
                                            <label for="arrival_day">Arrival Day</label>
                                            <select class="form-control" name="arrival_day" id="arrival_day">
                                                <option value="{{ old('arrival_day')}}">Choose a Day</option>    
                                                @forelse($dayLabels as $key => $dayLabel)
                                                    <option value="{{ $key}}">{{ $dayLabel}}</option>   
                                                @empty

                                                @endforelse
                                            </select>      
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-4 mb-sm-0">
                                        <div class="input-group">
                                            <label for="arrival_time">Arrival Time</label>
                                            <div class='input-group mt-1 timepicker'>
                                                <input type='text' id="arrival_time" name="arrival_time" class="form-control 
                                                @error('arrival_time') border border-danger @enderror" value="{{ old('arrival_time')}}" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-clock"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h2 class="h3 mb-0 text-gray-800">Stopover Details</h2>
                               </div>
                               <div class="form-group row"> 
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <div class="form-group">
                                            <label for="stopover_id">Stopover Airport</label>
                                            <select class="form-control" name="stopover_id" id="stopover_id">
                                                <option value="{{ old('stopover_id')}}">Choose a Airport</option>    
                                                @forelse($stopovers as $stopover)
                                                    <option value="{{ $stopover->id}}">{{ $stopover->IATA}} ({{ $stopover->name}})</option>   
                                                @empty

                                                @endforelse
                                            </select>      
                                        </div>
                                    </div>
                               </div>
                               <div class="form-group row"> 
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <div class="form-group">
                                            <label for="stop_arrival_day">Stopover Arrival Day</label>
                                            <select class="form-control" name="stop_arrival_day" id="stop_arrival_day">
                                                <option value="{{ old('stop_arrival_day')}}">Choose a Day</option>    
                                                @forelse($dayLabels as $key => $dayLabel)
                                                    <option value="{{ $key}}">{{ $dayLabel}}</option>   
                                                @empty

                                                @endforelse
                                            </select>      
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <div class="input-group">
                                            <label for="stop_arrival_time">Stopover Arrival Time</label>
                                            <div class='input-group mt-1 timepicker'>
                                                <input type='text' id="stop_arrival_time" name="stop_arrival_time" class="form-control 
                                                @error('stop_arrival_time') border border-danger @enderror" value="" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-clock"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                               <div class="form-group row"> 
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <div class="form-group">
                                            <label for="stop_departure_day">Stopover Departure Day</label>
                                            <select class="form-control" name="stop_departure_day" id="stop_departure_day">
                                                <option value="{{ old('stop_departure_day')}}">Choose a Day</option>    
                                                @forelse($dayLabels as $key => $dayLabel)
                                                    <option value="{{ $key}}">{{ $dayLabel}}</option>   
                                                @empty

                                                @endforelse
                                            </select>      
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <div class="input-group">
                                            <label for="stop_arrival_time">Stopover Departure Time</label>
                                            <div class='input-group mt-1 timepicker'>
                                                <input type='text' id="stop_departure_time" name="stop_departure_time" class="form-control 
                                                @error('stop_departure_time') border border-danger @enderror" value="" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-clock"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h2 class="h3 mb-0 text-gray-800">Flight Details</h2>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="aircraft">Aircraft</label>
                                        <select class="form-control" name="aircraft_id" id="aircraft">
                                            <option value="">Choose a user Aircraft</option>
                                            @foreach($aircrafts as $aircraft)
                                                <option value="{{$aircraft->id}}">{{$aircraft->registration}} ({{$aircraft->airline->name}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="sesson">Sessons</label>
                                        <select class="form-control" name="flight_category" id="sesson">
                                            <option>Choose a Sesson</option>
                                            @forelse($flight_categories as $flight_category)
                                            <option value="{{$flight_category->id}}">{{ $flight_category->name}}</option>
                                            @empty
                                            <option>No Flight Categories</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>  
                                </div>
                                <hr>  
                                <div class="form-group row">
                                </div>
                                <button type="submit" class="btn btn-success btn-user btn-block">
                                    Create Travel
                                </button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
        


@endsection

@push('datepicker-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.datetimepicker').datetimepicker({
                
                format: 'DD-MM-YYYY',
                defaultDate: null,
                
                
            })
        });
        </script>

        <script type="text/javascript">
            $(function () {
                $('.timepicker').datetimepicker({
                    format: 'HH:mm',
                })
            });
            </script>
@endpush

