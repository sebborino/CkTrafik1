@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush



        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Currencies</h1>
        </div>
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Currency</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">                               
                        <div class="p-5">
                            <div class="text-center">
                            </div>
                            <form action="{{ route('admin.price.currency.create')}}" class="user" method="post">
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
                                
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="name">Currency Name</label>
                                        <input type="text" name="name" class="form-control form-control-user
                                            @error('name') border border-danger @enderror" required id="name"
                                            placeholder="Full Name" value="{{ old('name')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="code">Currency Code</label>
                                        <input type="code" class="form-control form-control-user
                                            @error('username') border border-danger @enderror" name="code" required id="code"
                                            placeholder="Currency Code" value="{{ old('code')}}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-user btn-block">
                                    Register Currency
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Pie Chart -->
            <div class="col-xl-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Last Created Users</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Currency</th>
                                    <th>Code</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($currencies as $currency)
                                    <tr>
                                        <td>{{ $currency->name }}</td>
                                        <td>{{ $currency->currency_code }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $currency->id}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <p>No users</p>
                                @endforelse   

                            </tbody>
                        </table>
                        @forelse($currencies as $currency)
                        <!-- Modal -->
                        <div class="modal fade" id="Modal{{ $currency->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Change Name For {{ $currency->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{route('admin.price.currency.update', ['id' =>  $currency->id]) }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="update_name">Sesson Name</label>
                                            <input type="text" name="update_name" class="form-control form-control-user"  id="update_name"
                                                placeholder="Currency" value="{{ $currency->name }}">
                                        </div>   
                                        
                                        <label for="session">Currency Code</label>

                                        <input type="text" name="update_code" class="form-control form-control-user"  id="update_code"
                                            placeholder="Currency Code" value="{{ $currency->currency_code }}">

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


@endsection

@push('dataTable-scripts')
        <script src="/js/datatables/jquery.dataTables.min.js"></script>
        <script src="/js/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="/js/demo/datatables-demo.js"></script>
@endpush
