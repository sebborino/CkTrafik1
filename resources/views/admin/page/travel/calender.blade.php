@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Route {{ $route }}</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
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
                            
                            <div class="row mb-4">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                      <a class="nav-link active" aria-current="page" href="{{ route('admin.travels.calender', ['route' => $route ])}}">All</a>
                                    </li>
                                    @foreach($destinations as $destination)
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">{{ $destination->from->IATA}} - {{ $destination->to->IATA}}</a>
                                        </li>
                                    @endforeach
                                  </ul> 
                                </div>
                        <div class="calendar">

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
                                        <div  class="day {{$extraClass}}">
                                            <div class="calender-box">

                                            </div>
                                            <span class="content">{{ $startOfCalendar->format('d') }}</span>
                                        </div>
                                    {{ $startOfCalendar->addDay()->format('') }}
                                    @endwhile
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

@push('dataTable-scripts')
        <script src="/js/datatables/jquery.dataTables.min.js"></script>
        <script src="/js/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="/js/demo/datatables-demo.js"></script>
@endpush
