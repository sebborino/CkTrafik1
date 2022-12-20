@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Class Type</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                </div>
                    <div class="card-body">

                        <form action="{{ route('admin.classtype.create')}}" class="user" method="post">
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
                                <div class="col-md-7">
                                    <label for="name">Class Type</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-user
                                    @error('name') border border-danger @enderror"
                                        placeholder="Class Type fx. One Way" value="{{ old('name')}}"
                                     />
                                </div>

                                <div class="col-md-5">
                                    <label for="code">Class Type Code</label>
                                    <input type="text" name="code"id="code" class="form-control form-control-user
                                    @error('name') border border-danger @enderror"
                                        placeholder="Class Type fx. OW" value="{{ old('code')}}"
                                     />
                                </div>
                            </div>
                            <button type="submit" class="btn custom btn-user btn-block">
                                Create Class Type
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
                        <h6 class="m-0 font-weight-bold text-primary">Created Rates</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Class Type</th>
                                        <th>Class Code</th>
                                        <th>Edit</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($classTypes as $classType)
                                    <tr>
                                        <td>
                                            {{ $classType->name }}
                                        </td>
                                        <td>
                                            {{ $classType->class_type_code }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Modal{{ $classType->id}}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                        <td>{{ $classType->created_at }}</td>
                                    </tr>
                                    @empty
                                        <p>No Class Types</p>
                                    @endforelse
                                </tbody>
                            </table>
                            @forelse($classTypes as $classType)
                            <!-- Modal -->
                            <div class="modal fade" id="Modal{{ $classType->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change {{ $classType->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{route('admin.classtype.update', ['id' =>  $classType->id]) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <h5>Sure you want to delete the Rate</h5>
                                        </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close X</button>
                                    <button type="sumbmit" class="btn btn-primary">Yes Delete</button>
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
