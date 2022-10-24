@extends('admin.layout.app')

@section('content')

@push('dataTable-css')
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
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
                        @admin
                        <form action="{{ route('admin.price.adminUpdate', ['id' => $destination->id])}}" method="post">
                        @endadmin

                        @staff
                        <form action="{{ route('admin.price.staffUpdate', ['id' => $destination->id])}}" method="post">
                        @endstaff
                        @csrf
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fare</th>
                                    <th>CLASS</th>
                                    <th>PTC</th>
                                    <th>Price(DKK)</th>
                                    <th>
                                        Rules
                                    </th>
                                    @admin
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    @endadmin   
                                </tr>
                            </thead>
                            <tbody>
                                
                                @forelse($destination->classes as $class)
                                <tr>
                                    @admin
                                        <td><input type="text" class="form-control" name="fare[]" value="{{ $class->fare }}"/></td>
                                        <td><input type="text" class="form-control" name="class[]" value="{{ $class->class }}"/></td>
                                        <td><input type="text" class="form-control" name="ptc[]" value="{{ $class->ptc }}"/></td>
                                        <td><input type="number" class="form-control" name="price[]" value="{{ $class->price }}"/></td>
                                        <td>
                                            <a class="btn btn-light"data-toggle="modal" data-target="#Rules{{ $class->id}}">
                                                Rules
                                            </a>
                                        </td>
                                        <input type="hidden" class="form-control" name="id[]" value="{{ $class->id }}"/>
                                        <td>
                                            <a class="btn btn-danger" data-toggle="modal" data-target="#Delete{{ $class->id}}"><i class="fas fa-trash">
                                                </i></i>
                                            </a>
                                        </td>

                                        <td><button class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button></td>
                                    @endadmin    
                                    @staff
                                        <td>{{ $class->fare }}</td>
                                        <td>{{ $class->class }}</td>
                                        <td>{{ $class->ptc }}</td>
                                        <td><input type="number" class="form-control" name="price[]" value="{{ $class->price }}"/></td>
                                        <input type="hidden" class="form-control" name="id[]" value="{{ $class->id }}"/>

                                    @endstaff    
                                </tr>
                                
                                @empty
                                    <p>Add price on the blue Green</p>
                                    
                                @endforelse
                                
                            </tbody>
                        </table>
                        @if(count($destination->classes) > 0)
                            <p>
                                @staff
                                    
                                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                    
                                @endstaff
                                
                            </p>
                        @endif 
                    </form>
                    </div>
                    @forelse($destination->classes as $class)
                    <!-- Delete Modal -->
                    <div class="modal fade" id="Delete{{ $class->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Price {{ $destination->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want delete {{ $class->ptc }} {{ $class->class }} class</p>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="{{route('admin.price.delete', ['id' =>  $class->id]) }}" method="post">
                                @csrf
                                <button href="" type="sumbmit" class="btn btn-danger">Delete</button>
                            </form>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    <!-- Delete Modal End here -->

                     <!-- Rules Modal -->
                     <div class="modal fade" id="Rules{{ $class->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Rules For {{ $class->ptc }} {{ $class->class }} class</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <textarea name="editor1"></textarea>
                                        <p></p>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close X</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    <!-- Rules Modal End here -->

                    @empty

                    @endforelse
                    @admin
                    <button type="button" class="btn custom" data-toggle="modal" data-target="#Modal{{ $destination->id}}">
                        Add Prices
                      </button>
                     @endadmin 
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
<script>
    CKEDITOR.replace( 'editor1' );
</script>
@push('dataTable-scripts')

        <script src="/js/datatables/jquery.dataTables.min.js"></script>
        <script src="/js/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="/js/demo/datatables-demo.js"></script>
@endpush
