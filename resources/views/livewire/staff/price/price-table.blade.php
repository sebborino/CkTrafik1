
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
                                <th>Class Code</th>
                                <th>Destination</th>
                                <th>Sesson</th>
                                <th>Fare Price</th>
                                <th>Tax Price</th>
                                <th>More Price</th>
                                <th>Total Price</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prices as $price)
                                <tr>
                                    <td>{{$price->name}}</td>
                                    <td>{{$price->class_code}}</td>
                                    <td>{{$price->destination->from->IATA}}-{{$price->destination->to->IATA}}</td>
                                    <td>{{$price->flight_category->name}}</td>
                                    <td>{{$price->price}} {{ $price->currency->currency_code}}</td>
                                    <td>{{$price->tax_price}} {{ $price->currency->currency_code}}</td>
                                    <td>{{$price->more_price}} {{ $price->currency->currency_code}}</td>
                                    <td>{{$price->price + $price->more_price + $price->tax_price}} {{ $price->currency->currency_code}}</td>
                                </tr>
                                
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

