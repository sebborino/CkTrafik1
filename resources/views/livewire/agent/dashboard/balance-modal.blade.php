<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    @if(is_null($agent->bank))
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Balance</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Locked
                        </div>
                    @elseif($agent->bank->accept != true)
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Balance
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Confirm Required
                        </div>
                    @elseif($agent->bank->accept == true)
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                           Balance
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ is_null($agent->bank->closed_at) ? $agent->bank->balance : 'Closed' }}
                        </div>
                    @endif
                </div>
                <div class="col-auto">
                    <i class="fas fa-wallet fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>