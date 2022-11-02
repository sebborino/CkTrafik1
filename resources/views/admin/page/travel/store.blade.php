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
                           
                            <form action="{{ route('admin.travel.create', ['id' => $destination->id , 'date' => $date])}}" class="user" method="post">
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
                                    <h2 class="h3 mb-0 text-gray-800">Travel Details</h2>
                                </div>
                                <div class="form-group row"> 
                                
                                    <div class="col-sm-4 mb-4 mb-sm-0">
                                        <label for="destination">Destination</label>
                                        <input type="text" id="destination" value="{{ $destination->from->IATA .'-'.$destination->to->IATA }}" readonly class="form-control
                                            @error('name') border border-danger @enderror" required id="name"
                                            placeholder="Full Name">
                                    </div>
                                    <div class="col-sm-4 mb-4 mb-sm-0">
                                        <label for="date">Departure Date</label>
                                        <input type="text" id="date" value="{{ $dateWM }} ({{ $nameOfWeek }})" readonly class="form-control" 
                                        required placeholder="Departure Date">
                                        <input type="hidden"  name="departure_date" value="{{ $date }}" class="form-control" 
                                        required placeholder="Departure Date">
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
                                        <div class="input-group">
                                            <label for="arrival_date">Arrival Date</label>
                                            <div class='input-group mt-1 datetimepicker'>
                                                <input type="text" id="arrival_date" name="arrival_date" value="" class="form-control
                                                @error('arrival_date') border border-danger @enderror" value="{{ old('arrival_date')}}" placeholder="Arrival Date">
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
                                        <div class="input-group">
                                            <label for="stop_arrival_date">Stopover Arrival Date</label>
                                            <div class='input-group mt-1 datetimepicker'>
                                                <input type="text" id="stop_arrival_date" name="stop_arrival_date" class="form-control
                                                @error('stop_arrival_date') border border-danger @enderror" value="{{ old('stop_arrival_date')}}" placeholder="Arrival Date">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-calendar"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <div class="input-group">
                                            <label for="stop_arrival_time">Stopover Arrival Time</label>
                                            <div class='input-group mt-1 timepicker'>
                                                <input type='text' id="stop_arrival_time" name="stop_arrival_time" class="form-control 
                                                @error('stop_arrival_time') border border-danger @enderror" value="{{ old('stop_arrival_time')}}" />
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
                                        <div class="input-group">
                                            <label for="stop_departure_date">Stopover Departure Date</label>
                                            <div class='input-group mt-1 datetimepicker'>
                                                <input type="text" id="stop_departure_date" name="stop_departure_date" value="" class="form-control
                                                @error('stop_departure_date') border border-danger @enderror" value="{{ old('stop_departure_date')}}" placeholder="Arrival Date">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-calendar"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <div class="input-group">
                                            <label for="stop_arrival_time">Stopover Departure Time</label>
                                            <div class='input-group mt-1 timepicker'>
                                                <input type='text' id="stop_departure_time" name="stop_departure_time" class="form-control 
                                                @error('stop_departure_time') border border-danger @enderror" value="{{ old('stop_departure_time')}}" />
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
                                </div>
                                <hr>
                                <div class="form-group">

                                </div>
                                <div class="form-group">
                                    <label for="role">User Roles</label>
                                    <select class="form-control" name="role" id="role">
                                        <option value="">Choose a user role</option>    
                                              
                                    </select>      
                                </div>

                                <div class="form-group row">
                                </div>
                                <button type="submit" class="btn btn-success btn-user btn-block">
                                    Register User
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
                format: 'DD-MM-YYYY'
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

