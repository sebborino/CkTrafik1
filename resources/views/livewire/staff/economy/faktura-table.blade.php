<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><input type="checkbox"/> All</th>
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
                    @forelse($fakturas as $faktura)
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
                                <i class="fas fa-file-pdf " aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
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
