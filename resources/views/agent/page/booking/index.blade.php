@extends('agent.layout.app')

@section('content')

@push('dataTable-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Booking</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                </div>
                    <div class="card-body">

                        <form action="{{ route('agent.booking.search')}}" class="user" method="post">
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
                                <livewire:agent.booking.booking-airport-input :name="'from'" :title="'From'" />
                                <livewire:agent.booking.booking-airport-input :name="'to'" :title="'To'" />
                                <livewire:agent.booking.booking-calender :name="'departure_date'" :title="'Departure Date'"/>
                            </div>
                                <livewire:agent.booking.booking-return />
                            <button type="submit" class="btn custom btn-user btn-block">
                                Search
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
                        <h6 class="m-0 font-weight-bold text-primary">Created Destinations</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Destinations</th>
                                        <th>Flight</th>
                                        <th>Edit</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ations</p>
                                 
                                </tbody>
                            </table>

                            
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- /.container-fluid -->

@endsection

@push('dataTable-scripts')
        <script>
            flatpickr(".datetimepicker",{
                allowInput: true,
            });
        </script>
@endpush
