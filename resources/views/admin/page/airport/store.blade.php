@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Airports</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                </div>
                    <div class="card-body">

                        <form action="{{ route('admin.airport.create')}}" class="user" method="post">
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
                            
                                <div class="col-md-6">
                                    <label for="name">Airports</label>
                                    <input type="text" name="name" class="form-control form-control-user
                                        @error('name') border border-danger @enderror"  id="name"
                                        placeholder="Airport Name" value="{{ old('name')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="IATA">IATA</label>
                                    <input type="text" name="IATA" class="form-control form-control-user
                                        @error('IATA') border border-danger @enderror"  id="IATA"
                                        placeholder="IATA Code" value="{{ old('IATA')}}">
                                </div>
                            </div>
                            <div class="form-group row"> 

                                <div class="col-md-4">
                                    <label for="location">location</label>
                                    <input type="text" name="location" class="form-control form-control-user
                                        @error('location') border border-danger @enderror"  id="location"
                                        placeholder="Location" value="{{ old('location')}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="country_code">Country Code</label>
                                    <input type="text" name="country_code" class="form-control form-control-user
                                        @error('country_code') border border-danger @enderror"  id="country_code"
                                        placeholder="Contry Code" value="{{ old('country_code')}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="timezone">Timezone</label>
                                    <input type="text" name="timezone" class="form-control form-control-user
                                        @error('timezone') border border-danger @enderror"  id="timezone"
                                        placeholder="Full Name" value="{{ old('timezone')}}">
                                </div>
                                
                            </div>
                            <button type="submit" class="btn custom btn-user btn-block">
                                Create Airport
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
                        <h6 class="m-0 font-weight-bold text-primary">Created Airports</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Airport Name</th>
                                        <th>IATA</th>
                                        <th>Location</th>
                                        <th>Country Code</th>
                                        <th>Timezone</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($airports as $airport)
                                    <tr>
                                        <td><a href="{{ route('admin.airport.index', ['IATA' => $airport->IATA, 'id' => $airport->id])}}">{{ $airport->name }}</a></td>
                                        <td>{{ $airport->IATA }} IATA</td>
                                        <td>{{ $airport->country_code }}</td>
                                        <td>{{ $airport->location }}</td>
                                        <td>{{ $airport->timezone }}</td>
                                        <td>{{ $airport->created_at }}</td>
                                    </tr>
                                    @empty
                                        <p>No Airports in the system!</p>
                                    @endforelse
                                </tbody>
                            </table>
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
