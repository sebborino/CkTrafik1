<div>
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
        <div class="col-4"></div>
        <div class="col-4">
            <div
                class="block float-right form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="number" wire:model="paginate" class="form-control bg-light border-0 small" placeholder="Number"
                        aria-label="Number" aria-describedby="basic-addon2">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><input wire:click="all" type="checkbox"/> All</th>
                        <th>Faktura Nr.</th>
                        <th>E ticket</th>
                        <th>PNR</th>
                        <th>Fare Price</th>
                        <th>Tax</th>
                        <th>Total Price</th>
                        <th>Agent</th>
                        <th>Dato</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fakturas as $index => $faktura)
                        <tr>
                            
                            <th><input type="checkbox"/></th>
                            <td>{{ $faktura->fak_nr}}</td>
                            <td>{{ $faktura->e_ticket}}</td>
                            <td>{{ $faktura->pnr}}</td>
                            <td>{{ number_format( $faktura->fare_price , 2 , ',' , '.' )}}</td>
                            <td>{{ $faktura->tax}}</td>
                            <td>{{ number_format( $faktura->fare_price + $faktura->tax , 2 , ',' , '.' )}}</td>
                            <td>{{ $faktura->agent}}</td>
                            <td>{{ $faktura->dato}}</td>
                            <td>
                                <a wire:click="download({{$faktura->id}})" class="text-danger">
                                    <i class="fas fa-file-pdf" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @if(!empty($checked))
                        hey
                        @endif
                       
                    @empty    
                        No PDF's have been uploaded
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {!! $fakturas->links() !!}
            </div>
        </div>
    </div>
</div>
