@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Destination</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                </div>
                    <div class="card-body">

                        <form action="{{ route('admin.destination.create')}}" class="user" method="post">
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
                            
                            <div class="form-group row"> 
                            
                                <div class="col-md-4">
                                    <label for="name">Destination From</label>
                                    <select name="from" class="form-control">
                                        <option value="0" selected>Choose Airport From</option>
                                        @foreach($airports as $airport)
                                            <option value="{{ $airport->id }}">{{ $airport->IATA }}({{ $airport->name }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="name">Destination To</label>
                                    <select name="to" class="form-control">
                                        <option value="0" selected>Choose Airport To</option>
                                        @foreach($airports as $airport)
                                            <option value="{{ $airport->id }}">{{ $airport->IATA }}({{ $airport->name }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                

                                <div class="col-md-4">
                                    <label for="name">Flight</label>
                                    <select name="flight" class="form-control">
                                        <option value="0" selected>Choose Flight</option>
                                        @foreach($flights as $flight)
                                            <option value="{{ $flight->id }}">{{ $flight->route }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                
                            </div>
                            <button type="submit" class="btn custom btn-user btn-block">
                                Create Destination
                            </button>
                        </form>

                        
                    </div>
                </div>
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
                                        <th>Flight</th>
                                        <th>Edit</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($destinations as $destination)
                                    <tr>
                                        <td>{{ $destination->from->IATA }}-{{ $destination->to->IATA }}
                                            <ul>
                                                <li>{{ $destination->from->name }}</li>
                                                <li>{{ $destination->to->name }}</li>
                                                
                                            </ul>
                                        </td>
                                        <td>
                                            Route
                                            <li>{{ $destination->flight->route }}</li>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $destination->id}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </td>
                                        
                                        <td>{{ $destination->created_at }}</td>
                                    </tr>
                                    @empty
                                        <p>No Destinations</p>
                                    @endforelse
                                </tbody>
                            </table>
                            @forelse($destinations as $destination)
                            <!-- Modal -->
                            <div class="modal fade" id="Modal{{ $destination->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change {{ $destination->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{route('admin.destination.update', ['id' =>  $destination->id]) }}" method="post">
                                        @csrf
                                        <div class="modal-body">

                                                <label class="my-2" for="name">Destination From</label>
                                                <select name="update_from" class="form-control">

                                                    <option value="{{ $destination->from_id }}">{{ $destination->from->IATA }}({{ $destination->from->name }})</option>
                                                    @foreach($airports as $airport)
                                                        @continue($airport->id == $destination->from->id)
                                                        <option value="{{ $airport->id}}">{{ $airport->IATA}} {{ $airport->name}}</option>
                                                        
                                                    @endforeach
                                                </select>

                                                <label class="my-2" for="name">Destination From</label>
                                                <select name="update_to" class="form-control">

                                                    <option value="{{ $destination->to_id }}">{{ $destination->to->IATA }}({{ $destination->to->name }})</option>
                                                    @foreach($airports as $airport)
                                                        @continue($airport->id == $destination->to_id)
                                                        <option value="{{ $airport->id}}">{{ $airport->IATA}} {{ $airport->name}}</option>
    
                                                    @endforeach
                                                </select>

                                                <label class="my-2" for="name">Destination From</label>
                                                <select name="update_flight" class="form-control">

                                                    <option value="{{ $destination->flight_id }}">{{ $destination->flight->route }}</option>
                                                    @foreach($flights as $flight)
                                                        @continue($flight->id == $destination->flight_id)
                                                        <option value="{{ $flight->id}}">{{ $flight->route}}</option>
                                                        
                                                    @endforeach
                                                </select>

                                        </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close X</button>
                                    <button type="sumbmit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                    </form>
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
