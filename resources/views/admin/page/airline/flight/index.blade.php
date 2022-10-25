@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Flights</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                </div>
                    <div class="card-body">
                       @if($check_airline > 0)
                        <form action="{{ route('admin.flight.create')}}" class="user" method="post">
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
                            
                            @elseif(Session::has('update'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <h4 class="alert-heading">Well done!</h4>
                                <p>{!! Session::get('update') !!}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            @endif
                            
                            <div class="form-group row"> 
                            
                                <div class="col-md-6">
                                    <label for="number">Flights Number</label>
                                    <input type="text" name="number" class="form-control form-control-user
                                        @error('number') border border-danger @enderror"  id="number"
                                        placeholder="Flight Number" value="{{ old('number')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="boeing">Boeing</label>
                                    <input type="text" name="boeing" class="form-control form-control-user
                                        @error('boeing') border border-danger @enderror"  id="boeing"
                                        placeholder="Boeing" value="{{ old('boeing')}}">
                                </div>
                                
                            </div>

                            <div class="form-group row"> 
                            
                                <div class="col-md-6">
                                    <label for="name">Airline</label>
                                    <select name="airline_id" class="form-control
                                    @error('airline_id') border border-danger @enderror" id="airline">
                                        <option value="0">Choose Airline</option>
                                        @foreach($airlines as $airline)
                                            <option value="{{ $airline->id}}">{{ $airline->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-md-6">
                                    <label for="seats_capacity">Seats Capacity</label>
                                    <input type="number" name="seats_capacity" class="form-control form-control-user
                                        @error('seats_capacity') border border-danger @enderror"  id="seats_capacity"
                                        placeholder="Seats Capacity" value="{{ old('seats_capacity')}}">
                                </div>
                                
                            </div>
                            <button type="submit" class="btn custom btn-user btn-block">
                                Create Flights
                            </button>
                        </form>
                        @else
                            <h5 class="text">Before you can make any flights, you have to make aleast a airline, you can connect your flights with! Go to Create
                                <a href="{{ route('admin.airline.index')}}">Airline Here</a>
                            </h5>
                        @endif

                        
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Created Flights</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Flight Number</th>
                                        <th>Boeing</th>
                                        <th>Airline</th>
                                        <th>Seats Capacity</th>
                                        <th>Edit</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($flights as $flights)
                                    <tr>
                                        <td>{{ $airline->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $airline->id}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </td>
                                        <td>{{ $airline->created_at }}</td>
                                    </tr>
                                    @empty
                                        <p>No Flights</p>
                                    @endforelse
                                </tbody>
                            </table>
                            @forelse($airlines as $airline)
                            <!-- Modal -->
                            <div class="modal fade" id="Modal{{ $airline->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Name For {{ $airline->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{route('admin.airline.update', ['id' =>  $airline->id]) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Airline Name</label>
                                                <input type="text" name="name" class="form-control form-control-user"  id="name"
                                                    placeholder="Airline Name" value="{{ $airline->name }}">
                                            </div>                              
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
