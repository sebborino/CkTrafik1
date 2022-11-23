<div class="card-body">
    @if(Session::has('error'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>OPS!</strong>  {!! Session::get('error') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif(Session::has('message'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Well done!</h4>
        <p>{!! Session::get('message') !!}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
    @endif
    <h5 class="card-title">Confirm Wallet</h5>
    <h6>{{ $notification->created_at }}</h6>
    <p class="card-text">For confirming your wallet, then read and accept terms.</p>
    <ul>
        <li>Ck Trafik 1 Have permission to close the Wallet, in the system, if you not follow the rules.</li>
        <li>Ck Trafik 1 Have permission to close the Wallet, in the system, if we think the balance is incorrect.</li>
        <li>Ck Trafik 1 Have permission to close the Wallet, in the system, if we need some payments.</li>
    </ul>
    <div class="form-check">
        <input wire:click="toggle_term" type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Accept Term</label>
        
    </div>
    <button wire:click="accept" @if($term == false) disabled @endif class="btn btn-primary">Accept</button>
</div>