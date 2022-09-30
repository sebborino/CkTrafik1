@extends('agent.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Prices</h1>

    <!-- DataTales Example -->
    <div class="row">
    @forelse($destinations as $destination)

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $destination->name }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fare</th>
                                    <th>CLASS</th>
                                    <th>PTC</th>
                                    <th>Price(DKK)</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @forelse($destination->classes as $class)
                                <tr>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modal{{ $class->id }}">
                                            {{ $class->fare }}
                                        </a>
                                    </td>
                                    <td>{{ $class->class }}</td>
                                    <td>{{ $class->ptc }}</td>
                                    <td>{{ $class->price }}</td>
                                <!-- Button trigger modal -->
                                
                                <!-- Modal -->
                                <div class="modal fade" id="modal{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Rules for {{ $class->class }} Class</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        ...
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>    
                                </tr>
                                @empty
                                <p>No Prices for this destination</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
    @empty
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                </div>
                <div class="card-body">
                <p>No prices on the system</p>
                </div>
            </div>
        </div>
    @endforelse
</div>
</div>
<!-- /.container-fluid -->


@endsection

@push('dataTable-scripts')
        <script src="/js/datatables/jquery.dataTables.min.js"></script>
        <script src="/js/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="/js/demo/datatables-demo.js"></script>
@endpush
