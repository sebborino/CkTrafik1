@extends('admin.layout.app')

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
                        <form action="{{ route('admin.price.update', ['id' => $destination->id])}}" method="post">
                        @csrf
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
                                    <td><input type="text" class="form-control" name="fare[]" value="{{ $class->fare }}"/></td>
                                    <td><input type="text" class="form-control" name="class[]" value="{{ $class->class }}"/></td>
                                    <td><input type="text" class="form-control" name="ptc[]" value="{{ $class->ptc }}"/></td>
                                    <td><input type="number" class="form-control" name="price[]" value="{{ $class->price }}"/></td>
                                    <td><input type="hidden" class="form-control" name="id[]" value="{{ $class->id }}"/></td>
                                </tr>
                               
                                @empty
                                    <p>Add price on the blue Green</p>
                                    
                                @endforelse
                                
                            </tbody>
                        </table>
                        @if(count($destination->classes) > 0)
                            <p>
                                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                            </p>
                        @endif 
                    </form>
                    </div>

                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modal{{ $destination->id}}">
                        Add Prices
                      </button>
                      
                      <!-- Modal -->
                      <div class="modal fade" id="Modal{{ $destination->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Adding Price for {{ $destination->name }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{route('admin.price.create', ['id' =>  $destination->id]) }}" method="post">
                                @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="fare">Fare</label>
                                    <input type="text" name="fare" class="form-control form-control-user
                                        @error('fare') border border-danger @enderror"  id="fare"
                                        placeholder="Fare" value="{{ old('fare')}}">
                                </div>
                                <div class="form-group">
                                    <label for="class">Class</label>
                                    <input type="text" class="form-control form-control-user
                                        @error('class') border border-danger @enderror" name="class" required id="class"
                                        placeholder="Class" value="{{ old('class')}}">
                                </div>

                                <div class="form-group">
                                    <label for="ptc">PTC</label>
                                    <input type="text" class="form-control form-control-user
                                        @error('ptc') border border-danger @enderror" name="ptc" required id="ptc"
                                        placeholder="PTC" value="{{ old('ptc')}}">
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control form-control-user
                                        @error('price') border border-danger @enderror" name="price" required id="price"
                                        placeholder="Price(DKK)" value="{{ old('price')}}">
                                </div>
                              
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="sumbmit" class="btn btn-primary">Save Prices</button>
                            </div>
                            </form>
                          </div>
                        </div>
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
                <p>Before adding prices, you need to have some destinations. Go to the Destination page and add some Destinations 
                    <a href="{{ route('admin.destination.index')}}">here</a></p>
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
