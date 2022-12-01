@extends('admin.layout.app')

@section('content')

@push('datepicker-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/datepicker/css/bootstrap.css" />
@endpush

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ $destination->from->IATA}}-{{ $destination->to->IATA}}</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">  
                <div class="card-header">

                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <form method="post" action="{{ route('admin.travel.calender', ['id' => $destination->id])}}">
                                @csrf
                                <button type="submit" name="subDate" value="{{ $startOfCalendar->copy()->endOfWeek()->subMonths() }}" class="nav-link btn btn-success">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    
                                    {{ $startOfCalendar->copy()->endOfWeek()->subMonth()->monthName }}
                                </button>
                            </form>
                        </div>
                        <div class="d-flex">
                            <button type="button" class="nav-link btn btn-primary" data-toggle="modal" data-target="#ModalDatetimepicker" >
                                Choose Date
                                <i class="fas fa-calendar ml-1"></i>
                            </button>
                        </div>
                        <div class="d-flex">
                            <form method="post" action="{{ route('admin.travel.calender', ['id' => $destination->id])}}">
                                @csrf
                                <button type="submit" name="addDate" value="{{ $startOfCalendar->copy()->endOfWeek()->addMonths() }}" class="nav-link btn btn-success">
                                    {{ $startOfCalendar->copy()->endOfWeek()->addMonth()->monthName }}
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                  <!-- Modal -->
                <div class="modal fade" id="ModalDatetimepicker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Choose Date</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form action="{{ route('admin.travel.calender',['id' => $destination->id])}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="container">
                                        <div class="input-group">
                                            <div class='input-group date' id='datetimepicker'>
                                                <input type='text' name="date" class="form-control" />
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-calendar"></i>
                                                </button>
                                            </div>
                                        </div>
                                     </div>
                                </div> 
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close X</button>
                        <button type="sumbmit" class="btn btn-primary">Show Calender</button>
                        </div>
                        </form>
                    </div>
                z</div>
                </div>
                <!-- /Modal end here -->
                </form>
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
                            
                        <div class="calendar" style="background:#f8f9fc">

                            <div class="month-year">
                                <span class="month">{{ $date->format('M') }}</span>
                                <span class="year">{{ $date->format('Y') }}</span>
                            </div>
                    
                            <div class="days">
                                @foreach($dayLabels as $dayLabel)
                                
                                <span class="day-label">{{ $dayLabel }}</span>
                                @endforeach
                                <div class="dates">
                                    @while($startOfCalendar <= $endOfCalendar)
                                        @php
                                            $extraClass = $startOfCalendar->format('m') != $date->format('m') ? 'dull' : '';
                                            $extraClass .= $startOfCalendar->isToday() ? ' today' : ''; 
                                        @endphp
                                        @foreach($travels as $travel)
                                            @if($startOfCalendar->format('d-m-Y') == Carbon\Carbon::createFromDate($travel->departure_date)->format('d-m-Y'))
                                                <a href="{{ route('admin.travel.edit', ['date' => $startOfCalendar->format('d-m-Y'), 'id' => $travel->id])}}" class="day {{$extraClass}}">
                                                    <div class="calender-box text-center pt-3">                              
                                                        <i class="fas fa-plane" style="font-size:40px"></i>
                                                        <h6>{{ $travel->destination->from->IATA}} - 
                                                            @if(isset($travel->stopover_id))
                                                            {{ $travel->stopover->IATA}}
                                                            - 
                                                            @endif
                                                            {{ $travel->destination->to->IATA}}</h6>
                                                    </div>
                                                    <span class="content">{{ $startOfCalendar->format('d M') }} </span>
                                                    
                                                </a>
                                              
                                                @if(!$travel->departure_date == $endOfCalendar->format('Y-m-d'))
                                                {
                                                    hey
                                                }
                                                @endif
                                                    {{ $startOfCalendar->addDay()->format('') }}
                                                
                                                
                                            @endif 
                                           
                                        @endforeach
                                            @if(!isset($travel->departure_date) || $startOfCalendar->format('d-m-Y') != Carbon\Carbon::createFromDate($travel->departure_date)->format('d-m-Y'))
                                                <a href="{{ route('admin.travel.store', ['date' => $startOfCalendar->format('d-m-Y'), 'id' => $destination->id])}}" class="day {{$extraClass}}">
                                                    <div class="calender-box text-center pt-3">                              

                                                    </div>
                                                    <span class="content">{{ $startOfCalendar->format('d M') }} </span>
                                                    
                                                </a>
                                               
                                                {{ $startOfCalendar->addDay()->format('') }}
                                            @endif       
                                    @endwhile
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


@endsection

@push('datepicker-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker({
                viewMode: 'years',
                format: '01-MM-YYYY'
            })
        });
        </script>
@endpush



@push('dataTable-scripts')
    <script src="/js/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/js/demo/datatables-demo.js"></script>
@endpush
