@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Sesson</h1>
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
                                        placeholder="Sesson Name" value="{{ old('name')}}"/>
                                </div>

                                <div class="col-md-4">
                                    <label for="session">Sesson/Category Name</label>
                                    <select name="flight" class="form-control
                                        @error('flight') border border-danger @enderror"  id="flight"
                                        placeholder="ex. High" value="{{ old('flight')}}">
                                        <option value="" selected>Choose Flight Route</option>

                                        @forelse($flights as $flight)
                                        <option value="{{$flight->id}}">{{$flight->route}} ({{$flight->airline->name}})</option>
                                        @empty
                                        
                                        <option value="">No Airlines</option>
                                        
                                        @endforelse
                                        
                                    </select>
                                </div>
                                
                            </div>
                            <button type="submit" class="btn custom btn-user btn-block">
                                Create Sesson
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
                        <h6 class="m-0 font-weight-bold text-primary">Created Sessons</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sessons Name</th>
                                        <th>Route Name</th>
                                        <th>Airline</th>
                                        <th>Edit</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sessons as $sesson)
                                    <tr>
                                        <td>{{ $sesson->name }}</td>
                                        <td>{{ $sesson->flight->route }}</td>
                                        <td>{{ $sesson->flight->airline->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $sesson->id}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </td>
                                        <td>{{ $sesson->created_at }}</td>
                                    </tr>
                                    @empty
                                        <p>No Sessons</p>
                                    @endforelse
                                </tbody>
                            </table>
                            @forelse($sessons as $sesson)
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
                                                <label for="name">Sesson Name</label>
                                                <input type="text" name="update_name" class="form-control form-control-user"  id="name"
                                                    placeholder="Sesson Name" value="{{ $sesson->name }}">
                                            </div>   
                                            
                                            <label for="session">Sesson/Category Name</label>
                                            <select name="update_flight" class="form-control
                                                @error('update_flight') border border-danger @enderror"  id="update_flight"
                                                value="{{ old('update_flight')}}">
                                                <option value="{{$sesson->flight->id}}" selected>{{$sesson->flight->route}} ({{$sesson->flight->airline->name}})</option>
                                                @foreach($flights as $flight)
                                                @if($flight->id != $sesson->flight->id)
                                                <option value="{{$flight->id}}">{{$flight->route}} ({{$flight->airline->name}})</option>
                                                @endif
                                                
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
