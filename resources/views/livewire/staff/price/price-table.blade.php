
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Created Flight Class</h6>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" wire:model="search" class="form-control bg-light border-0 small" placeholder="Search"
                                    aria-label="Search" aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <select wire:model="route" class="form-control">
                            <option value="">Choose Route</option>
                            @forelse($flights as $flight)
                                <option value="{{$flight->id}}">{{$flight->route}}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>
                    <div class="col-4">
                        <div
                            class="block float-right form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="number" wire:model="search" class="form-control bg-light border-0 small" placeholder="Search"
                                    aria-label="Number" aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Class Name</th>
                                <th>Destination</th>
                                <th>Sesson</th>
                                <th>Traveler Type</th>
                                <th>Class Type</th>
                                <th>Fare Price</th>
                                <th>Tax Price</th>
                                <th>More Price</th>
                                <th>Total Price</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($values as $value)
                            
                                <tr>
                                    <td>{{$value->class->name}}</td>
                                    <td>{{$value->class->destination->from->IATA}}-{{$value->class->destination->to->IATA}}</td>
                                    <td>{{$value->class->flight_category->name}}</td>
                                    <td>{{$value->traveler_type->name}}</td>
                                    <td>{{$value->class->class_type->name}}</td>
                                    <td>{{$value->price}} {{ $value->class->currency->currency_code}}</td>
                                    <td>{{$value->class->tax_price}} {{ $value->class->currency->currency_code}}</td>
                                    <td>{{$value->more_price}} {{ $value->class->currency->currency_code}}</td>
                                    <td>{{$value->price + $value->more_price + $value->class->tax_price}} {{ $value->class->currency->currency_code}}</td>
                                    <td></td>
                                </tr>
                                
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

