@extends('agent.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Notifications</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                </div>
                    <div class="card-body">
                       
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
                            
                                <div class="col-md-12">
                                    <label for="route">Agents</label>
                                    <input type="text" name="route" class="form-control form-control-user
                                        @error('route') border border-danger @enderror"  id="route"
                                        placeholder="fx. IA281" value="{{ old('route')}}">
                                </div>
                            </div>
                            <button type="submit" class="btn custom btn-user btn-block">
                                Create Flights
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
                        <h6 class="m-0 font-weight-bold text-primary">Created Flights</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Balance</th>
                                        <th>Edit</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @forelse($agents as $agent)
                                    <tr>
                                        <td><a href="{{ route('admin.agent.details', ['id' => $agent->id])}}">{{$agent->username}}</a></td>
                                        @if(isset($agent->bank))
                                            @if($agent->bank->accept == true)
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Close{{$agent->bank->id}}">
                                                    <i class="fas fa-wallet"></i>
                                                    Close Wallet
                                                </button>
                                            </td>
                                            @elseif($agent->bank->accept == false)
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Close{{$agent->bank->id}}">
                                                    <i class="fas fa-wallet"></i>
                                                    Waiting for Confirm
                                                </button>
                                            </td>
                                            @endif
                                        @else
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modal{{$agent->id}}">
                                                <i class="fas fa-wallet"></i>
                                                Open Wallet
                                            </button>
                                        </td>
                                        @endif
                                        <td>

                                        </td>
                                        <td></td>
                                    </tr>
                                    @empty
                                        <p>No Flights</p>
                                    @endforelse
                                </tbody>
                            </table>
                            
                            @forelse($agents as $agent)
                            @if(isset($agent->bank))
                            <!-- Modal -->
                            <div class="modal fade" id="Close{{$agent->bank->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Close Wallet</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{ route('admin.wallet.open',['id' => $agent->id])}}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <p>
                                                    Are you sure you want Close the Wallet for {{$agent->username}}
                                                </p>
                                            </div> 
                                        </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                    <button type="sumbmit" class="btn btn-primary">Yes</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            @else
                            <!-- Modal -->
                            <div class="modal fade" id="Modal{{$agent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Open Wallet</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{ route('admin.wallet.open',['id' => $agent->id])}}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <p>
                                                    Are you sure you want to send a request for open a wallet to {{$agent->username}}
                                                </p>
                                            </div> 
                                        </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                    <button type="sumbmit" class="btn btn-success">Yes! Send Request</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            @endif
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
