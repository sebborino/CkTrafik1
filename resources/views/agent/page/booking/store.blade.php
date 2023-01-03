@extends('agent.layout.app')

@section('content')

@push('dataTable-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Travels</h1>
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List</h6>
                </div>
                    <div class="card-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Travel</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @forelse($travels as $travel)
                                    <tr>
                                        <td>
                                            From {{$travel->destination->from->IATA}} ({{$travel->destination->from->name}})
                                            <ul>
                                                <li>
                                                     Departure {{$travel->departure_date}} {{$travel->departure_time}}
                                                </li>
                                            </ul>

                                            Duration
                                            <ul>
                                                <li>
                                                     hours {{$travel->duration}}
                                                </li>
                                            </ul>

                                            To {{$travel->destination->to->IATA}} ({{$travel->destination->to->name}})</li>
                                            <ul>
                                                <li>
                                                     Arrival {{$travel->arrival_date}} {{$travel->arrival_time}}
                                                </li>
                                            </ul>
                                         </td>
                                         <td>
                                            Prices
                                            <ul>
                                             @foreach($prices as $price)
                                            
                                            
                                                <li>{{$price->traveler_type->name}} - {{$price->price + $price->more_price}} {{$price->currency->currency_code}}</li>
                                                
                                            
                                            @endforeach
                                        </ul>
                                         </td>
                                    </tr>
                                 @empty
                                 <tr>
                                    <td>No Travels</td>
                                 </tr>
                                 @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
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
