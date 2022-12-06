<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>E ticket</th>
                        <th>PNR</th>
                        <th>Fare Price</th>
                        <th>Tax</th>
                        <th>Total Price</th>
                        <th>Total Price</th>
                        <th>Total Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fakturas as $faktura)
                    <tr>
                        <td>{{ $faktura->e-  ticket}}</td>
                        <td>{{ $faktura->pnr}}</td>
                    </tr>
                    @empty    
                        No PDF's have been uploaded
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
