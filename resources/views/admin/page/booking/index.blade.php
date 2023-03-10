@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Booking</h1>
    <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Created Flights</h6>
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
                            
                            @elseif(Session::has('update'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <h4 class="alert-heading">Well done!</h4>
                                <p>{!! Session::get('update') !!}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            @endif
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Booking Ref</th>
                                        <th>PNR</th>
                                        <th>Flight</th>
                                        <th>Agent</th>
                                        <th>Edit</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->ck_ref }} ({{count($booking->tickets)}})
                                        </td>
                                        <td>
                                            @if($booking->pnr)
                                                {{$booking->pnr}}
                                                @else
                                                No PNR
                                            <ul>
                                                @endif
                                                @foreach($booking->tickets as $ticket)
                                                <li>
                                                    @if($ticket->e_ticket)
                                                    <span class="badge badge-success">{{$ticket->e_ticket}}</span>
                                                    @else
                                                        <span class="badge badge-danger">Pending</span>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            @foreach($booking->tickets as $ticket)
                                            @if($loop->first)
                                            {{$ticket->travel->destination->from->IATA}} - {{$ticket->travel->destination->to->IATA}} ({{$ticket->travel->departure_date}})
                                            <ul>
                                                <li>Departure {{$ticket->travel->departure_time}}</li>
                                                @if($ticket->travel->stopover_id)
                                                <li>{{$ticket->travel->stopover}}</li>
                                                @else
                                                <li>0 stops</li>     
                                                @endif
                                                
                                            </ul>

                                            {{$ticket->travel->d
                                            }} - {{$ticket->travel->destination->to->IATA}} ({{$ticket->travel->departure_date}})
                                            <ul>

                                            </ul>
                                            <td>
                                                {{$booking->user->username}}
                                            </td>
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </td>
                                        
                                        <td>{{ $booking->created_at }}</td>
                                    </tr>
                                    @empty
                                        <p>No Destinations</p>
                                    @endforelse
                                </tbody>
                            </table>
                            @forelse($bookings as $booking)
                            <!-- Modal -->
                            <div class="modal fade" id="Modal}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Name For </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @empty
                            
                            @endforelse
                            <!-- /Modal end here -->
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
