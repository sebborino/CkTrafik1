@extends('agent.layout.app')

@section('content')

@push('dataTable-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@endpush

<!-- Begin Page Content -->
<div class="container-fluid">
<form action="">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Booking</h1>
    @for($x= 1; $x <= $travelerCount[0]; $x++)
    <div class="row">
        <div class="col-12">
            
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{$x}}. Adult </h6>
                </div>
                    <div class="card-body">
                    </div>
            </div>
        </div>
    </div>
    @endfor
</form>
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
