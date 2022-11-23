<div style="display: contents;">
    <div id="wallet-box" class="col-xl-3 col-md-6 mb-4"  data-target="#Bank" data-toggle="modal">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Request will be sent</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Open Wallet Here
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-wallet fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="Bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Balance</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <div class="modal-body">
                    <h2>Request Required</h2>
                    <p class="text-small">You need to send a request for the Agent, and he have to confirm terms to get a wallet. Press the blue button "Send Request" 
                        and a Notification with require details will be sent for the Agent.
                    </p>
                </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close X</button>
            <button wire:click="send"  class="btn btn-primary">Send Request</button>
            </div>
        </div>
        </div>
    </div>
    </div>