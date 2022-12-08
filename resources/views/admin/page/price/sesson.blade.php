@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Airline</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                </div>
                    <div class="card-body">

                        <form action="{{ route('admin.price.sesson.create')}}" class="user" method="post">
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
                            
                                <div class="col-md-8">
                                    <label for="name">Sesson Name</label>
                                    <input type="text" name="name" class="form-control form-control-user
                                        @error('name') border border-danger @enderror"  id="name"
                                        placeholder="Sesson Name" value="{{ old('name')}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="airline">Flight Route</label>
                                    <select name="airline" class="form-control
                                        @error('airline') border border-danger @enderror"  id="airline"
                                        placeholder="fx. IA281" value="{{ old('airline')}}">
                                        <option value="" selected>Choose Airline</option>

                                        @forelse($airlines as $airline)
                                        <option value="{{$airline->id}}">{{$airline->name}}</option>
                                        @empty
                                        
                                        <option value="">No Airlines</option>
                                        
                                        @endforelse
                                        
                                    </select>
                                </div>
                                
                            </div>
                            <button type="submit" class="btn custom btn-user btn-block">
                                Create Airline
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
                                        <th>Airline Name</th>
                                        <th>Airline IATA Code</th>
                                        <th>Edit</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sessons as $sessons)
                                    <tr>
                                        <td>{{ $sesson->name }}</td>
                                        <td>{{ $sesson->airline_code }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $sesson->id}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </td>
                                        <td>{{ $sesson->created_at }}</td>
                                    </tr>
                                    @empty
                                        <p>No Airlines</p>
                                    @endforelse
                                </tbody>
                            </table>
                            @forelse($airlines as $sesson)
                            <!-- Modal -->
                            <div class="modal fade" id="Modal{{ $sesson->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Name For {{ $sesson->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{route('admin.sesson.update', ['id' =>  $sesson->id]) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Airline Name</label>
                                                <input type="text" name="update_name" class="form-control form-control-user"  id="name"
                                                    placeholder="Airline Name" value="{{ $sesson->name }}">
                                            </div>   
                                            
                                            <div class="form-group">
                                                <label for="name">Airline IATA Code</label>
                                                <input type="text" name="update_airline_code" class="form-control form-control-user"  id="airline_code"
                                                    placeholder="Airline IATA Code" value="{{ $sesson->airline_code }}">
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
