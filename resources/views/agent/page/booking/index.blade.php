@extends('agent.layout.app')

@section('content')

@push('dataTable-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row">
        <div class="col-12">
            <livewire:agent.booking.booking-search />
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection

@push('dataTable-scripts')
        <script>
            flatpickr(".datetimepicker",{
                allowInput: true,
                minDate: "today",
            });

</script>
@endpush
