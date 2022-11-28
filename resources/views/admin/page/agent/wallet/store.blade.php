@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Wallet Settings</h1>
    <div class="row">
        <div class="col-4">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Agent {{ $bank->user->username }}</h6>
                </div>
                    <div class="card-body">
                       
                        <form action="{{ route('admin.wallet.update',['id' => $bank->id])}}" class="user" method="post">
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
                            <h2 class="">Balance {{ $bank->balance }}
                                @if(is_null($bank->closed_at)) 
                                <a class="float-right" data-toggle="modal" data-target="#Close">
                                    <i class="fas fa-lock-open left"></i>
                                </a>
                                @else
                                <a class="float-right" data-toggle="modal" data-target="#Open">
                                    <i class="fas fa-lock left"></i>
                                </a> 
                                @endif    
                            </h2>
                            <div class="form-group row mt-4"> 
                                <div class="col-md-12">
                                    <label for="coverdraft">Set Over Draft</label>
                                    <input type="number" name="coverdraft" class="form-control form-control-user
                                        @error('coverdraft') border border-danger @enderror"  id="coverdraft"
                                        placeholder="How much can the Deposit go in minus" value="{{ $bank->coverdraft}}">
                                </div>
                            </div>
                            <button type="submit" class="btn custom btn-user btn-block">
                                Save Settings
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Wallet Historisk</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Transfer Type</th>
                                        <th>Transfer</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($bank->transfers as $transfer)
                                    <tr>
                                        
                                        <td>{{ $transfer->bank_type }}
                                            <br/>
                                            <span class="text-xs text-black-50">{{ $transfer->created_at}}</span>
    
                                        </td>
                                        <td class="@if($transfer->bank_type == 'Deposit') 
                                            text-success
                                            @elseif($transfer->bank_type == 'Withdraw')
                                            text-danger
                                            @endif">
                                            
                                            {{ $transfer->balance_to - $transfer->balance_from}}
                                            <br />
                                            
                                            <span class="text-xs text-black-50">{{ $transfer->balance_to}}</span>
                                        </td>
                                    </tr>

                                    @empty
                                      
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Close Wallet-->
        <div class="modal fade" id="Close" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Close Wallet</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('admin.wallet.close',['id' => $bank->user->id])}}" method="post">
                @csrf
                
                <div class="modal-body">
                    <div class="form-group">
                        <p>
                            Are you sure, you want to Close up the Wallet For the Agent
                        </p>
                    </div> 
                </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            <button type="sumbmit" class="btn btn-success">Yes! Close Wallet</button>
            </div>
            </form>
        </div>
        </div>
    </div>
<!-- Wallet is Closed end here -->

<!-- Modal for Open Wallet-->
<div class="modal fade" id="Open" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Open Wallet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="{{ route('admin.wallet.open',['id' => $bank->user->id])}}" method="post">
            @csrf
            
            <div class="modal-body">
                <div class="form-group">
                    <p>
                        Are you sure, you want to Open up the Wallet For the Agent
                    </p>
                </div> 
            </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        <button type="sumbmit" class="btn btn-success">Yes! Open Wallet</button>
        </div>
        </form>
    </div>
    </div>
</div>
<!-- Wallet is Opened end here -->
</div>
<!-- /.container-fluid -->


@endsection

@push('dataTable-scripts')
        <script src="/js/datatables/jquery.dataTables.min.js"></script>
        <script src="/js/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="/js/demo/datatables-demo.js"></script>
@endpush
