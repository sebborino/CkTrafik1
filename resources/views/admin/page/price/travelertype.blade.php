@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Traveler Type</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                </div>
                    <div class="card-body">

                        <form action="{{ route('admin.travelerType.create')}}" class="user" method="post">
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
                                    <label for="name">Traveler Type Name</label>
                                    <input type="text" name="name" class="form-control
                                        @error('name') border border-danger @enderror"  id="name"
                                        placeholder="Traveler Type Name" value="{{ old('name')}}"/>
                                </div>

                                <div class="col-md-2">
                                    <label for="age_from">Age From</label>
                                    <input type="number" name="age_from" 
                                    class="form-control @error('age_from') border border-danger @enderror" id="age_from" value="{{ old('age_from')}}" placeholder="Age From">
                                </div>

                                <div class="col-md-2">
                                    <label for="age_to">Age From</label>
                                    <input type="number" name="age_to" 
                                    class="form-control @error('age_to') border border-danger @enderror" id="age_to" value="{{ old('age_to')}}" placeholder="Age To">
                                </div>
                                
                            </div>
                            <button type="submit" class="btn custom btn-user btn-block">
                                Create Traveler Type
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
                        <h6 class="m-0 font-weight-bold text-primary">Created Traveler Types</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Traveler Types Name</th>
                                        <th>Edit</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($travelerTypes as $travelerType)
                                    <tr>
                                        <td>{{ $travelerType->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $travelerType->id}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </td>
                                        <td>{{ $travelerType->created_at }}</td>
                                    </tr>
                                    @empty
                                        <p>No travelerTypes</p>
                                    @endforelse
                                </tbody>
                            </table>
                            @forelse($travelerTypes as $travelerType)
                            <!-- Modal -->
                            <div class="modal fade" id="Modal{{ $travelerType->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Details For {{ $travelerType->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{route('admin.travelerType.update', ['id' =>  $travelerType->id]) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="update_name">travelerType Name</label>
                                                <input type="text" name="update_name" class="form-control"  id="update_name"
                                                    placeholder="Traveler Type Name" value="{{ $travelerType->name }}">
                                            </div>   

                                            <div class="form-group">Age From</label>
                                                <input type="number" name="update_age_from" class="form-control"  id="update_age_from"
                                                    placeholder="Age From" value="{{ $travelerType->age_from }}">
                                            </div>   

                                            <div class="form-group">Age To</label>
                                                <input type="number" name="update_age_to" class="form-control"  id="update_age_to"
                                                    placeholder="Age To" value="{{ $travelerType->age_to }}">
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
