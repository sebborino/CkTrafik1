@extends('notification.app')

@section('notification')

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
    @if(!is_null($notification->read_at))
        <livewire:notification.read-at :notification="$notification" />
    @endif
    @if($bank == 0)
        <livewire:notification.wallet-request-form :notification="$notification" />
    @endif
</div>

@endsection

