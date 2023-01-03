@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Aircraft</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                </div>
                    <div class="card-body">
                       @if($check_airline > 0)
                        <form action="{{ route('admin.aircraft.create')}}" class="user" method="post">
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
                                    <label for="registration">Aircraft Registration</label>
                                    <input type="text" name="registration" class="form-control form-control-user
                                        @error('number') border border-danger @enderror"  id="registration"
                                        placeholder="Aircraft Registration" value="{{ old('registration')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="boeing">Aircraft Type</label>
                                    <input type="text" name="boeing" class="form-control form-control-user
                                        @error('boeing') border border-danger @enderror"  id="boeing"
                                        placeholder="Aircraft Type" value="{{ old('boeing')}}">
                                </div>
                                
                            </div>

                            <div class="form-group row"> 
                            
                                <div class="col-md-6">
                                    <label for="airline_id">Airline</label>
                                    <select name="airline_id" class="form-control
                                    @error('airline_id') border border-danger @enderror" id="airline_id">
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
                                Create Aircraft
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
                        <h6 class="m-0 font-weight-bold text-primary">Created Aircraft</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Aircraft Registration</th>
                                        <th>Aircraft Type</th>
                                        <th>Airline</th>
                                        <th>Seats Capacity</th>
                                        <th>Edit</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @forelse($aircrafts as $aircraft)
                                    <tr>
                                        
                                        <td>{{ $aircraft->registration }}</td>
                                        <td>{{ $aircraft->boeing }}</td>
                                        <td>{{ $aircraft->airline->name }}</td>
                                        <td>{{ $aircraft->seats_capacity }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $aircraft->id}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </td>
                                        <td>{{ $aircraft->created_at }}</td>
                                    </tr>
                                    @empty
                                        <p>No Aircrafts</p>
                                    @endforelse
                                </tbody>
                            </table>
                            @forelse($aircrafts as $aircraft)
                            <!-- Modal -->
                            <div class="modal fade" id="Modal{{ $aircraft->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Aircraft {{ $aircraft->registration }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{route('admin.aircraft.update', ['id' =>  $aircraft->id]) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="registration">Aircraft Registration</label>
                                                <input type="text" name="update_registration" class="form-control form-control-user"  id="registration"
                                                    placeholder="Aircraft Registration" value="{{ $aircraft->registration }}">
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="boeing">Boeing</label>
                                                <input type="text" name="update_boeing" class="form-control form-control-user"  id="boeing"
                                                    placeholder="Boeing" value="{{ $aircraft->boeing }}">
                                            </div> 

                                            <div class="form-group">
                                                <label for="airline">Airlines</label>
                                            <select name="update_airline_id" class="form-control" id="airline">
                                                    <option value="{{ $aircraft->airline->id}}">{{ $aircraft->airline->name}}</option>
                                                    @foreach($airlines as $airline)
                                                        @continue($airline == $aircraft->airline)
                                                        <option value="{{ $airline->id}}">{{ $airline->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="seats_capacity">Seats Capacity</label>
                                                <input type="text" name="update_seats_capacity" class="form-control form-control-user"  id="seats_capacity"
                                                    placeholder="Airline Name" value="{{ $aircraft->seats_capacity }}">
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
