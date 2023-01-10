@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Airport Tax</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                </div>
                    <div class="card-body">

                        <form action="{{ route('admin.tax.create')}}" class="user" method="post">
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

                                <div class="col-md-2">
                                    <label for="tax">Airport Tax</label>
                                    <input type="number" name="tax" class="form-control
                                        @error('tax') border border-danger @enderror" step=".01"  id="tax"
                                        placeholder="Amount" value="{{ old('tax')}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="currency">Currency</label>
                                    <select name="currency_id" class="form-control" id="currency">
                                        <option selected value="">Choose Currency</option>
                                        @forelse($currencies as $currency)
                                        <option value="{{$currency->id}}">{{$currency->currency_code}}</option>
                                        @empty
                                        <option value="">No Currencies</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="tax_code">Airport Tax Code</label>
                                    <input type="text" name="tax_code" class="form-control
                                        @error('tax_code') border border-danger @enderror"  id="tax_code"
                                        placeholder="Airport Tax Code" value="{{ old('tax_code')}}">
                                </div>

                                <div class="col-md-2">
                                    <label for="airport">Airport</label>
                                    <select name="airport_id" class="form-control" id="airport">
                                        <option selected value="">Choose Airport</option>
                                        @forelse($airports as $airport)
                                        <option value="{{$airport->id}}">{{$airport->name}}</option>
                                        @empty
                                        <option value="">No Airports</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="traveler">Traveler Type</label>
                                    <select name="traveler_id" class="form-control" id="traveler">
                                        <option selected value="">Choose Airport</option>
                                        @forelse($travelerTypes as $traveler)
                                        <option value="{{$traveler->id}}">{{$traveler->name}}</option>
                                        @empty
                                        <option value="">No traveler Types</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn custom btn-block">
                                Create Tax
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
                        <h6 class="m-0 font-weight-bold text-primary">Created taxes</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Airport Name</th>
                                        <th>Traveler Type</th>
                                        <th>Tax Code</th>
                                        <th>Tax Amount</th>
                                        <th>Currency</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($taxes as $tax)
                                    <tr>
                                        <td>{{ $tax->airport->name }}</td>
                                        <td>{{ $tax->travelerType->name }}</td>
                                        <td>{{ $tax->tax_code }}</td>
                                        <td>{{ $tax->tax }}</td>
                                        <td>{{ $tax->currency->currency_code }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $tax->id}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $tax->id}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                        <td>{{ $tax->created_at }}</td>
                                    </tr>
                                    @empty
                                        <p>No taxes in the system!</p>
                                    @endforelse
                                </tbody>
                            </table>
                            @forelse($taxes as $tax)
                            <!-- Modal -->
                            <div class="modal fade" id="Modal{{ $tax->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change {{ $tax->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{route('admin.tax.update', ['id' =>  $tax->id]) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="tax">Airport Tax</label>
                                                <input type="number" name="update_tax" class="form-control form-control-user"  id="tax"
                                                    placeholder="Airport" value="{{ $tax->tax }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="currency">Currency</label>
                                                <select name="update_currency_id" class="form-control mt-1">
                                                    <option selected value="{{$tax->currency_id}}">{{$tax->currency->currency_code}}</option>
                                                    @forelse($currencies as $currency)
                                                    @if($tax->currency_id != $currency->id)
                                                    <option value="{{$currency->id}}">{{$currency->currency_code}}</option>
                                                    @endif
                                                    @empty
                                                    <option value="">No Currencies</option>
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="update_tax_code">Tax Code</label>
                                                <input type="text" name="update_tax_code" class="form-control form-control-user"  id="update_tax_code"
                                                    placeholder="Tax Code" value="{{ $tax->tax_code }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="currency">Traveler Type</label>
                                                <select name="update_traveler_id" class="form-control mt-1">
                                                    <option selected value="{{$tax->currency_id}}">{{$tax->travelerType->name}}</option>
                                                    @forelse($travelerTypes as $traveler)
                                                    @if($tax->traveler_id != $traveler->id)
                                                    <option value="{{$traveler->id}}">{{$traveler->name}}</option>
                                                    @endif
                                                    @empty
                                                    <option value="">No Currencies</option>
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="currency">Airport</label>
                                                <select name="update_airport_id" class="form-control mt-1">
                                                    <option selected value="{{$tax->airport_id}}">{{$tax->airport->name}}</option>
                                                    @forelse($airports as $airport)
                                                    @if($tax->airport_id != $airport->id)
                                                    <option value="{{$airport->id}}">{{$airport->name}}</option>
                                                    @endif
                                                    @empty
                                                    <option value="">No Currencies</option>
                                                    @endforelse
                                                </select>
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
                            <!-- Delete Modal -->
                            <div class="modal fade" id="delete{{ $tax->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change {{ $tax->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{route('admin.tax.delete', ['id' =>  $tax->id]) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <h4>Are you sure you want to delete the Tax</h4>

                                        </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close X</button>
                                    <button type="sumbmit" class="btn btn-primary">Yes, Delete</button>
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
