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
    <h5 class="card-title">Wallet Open</h5>
    <h6>{{ $notification->created_at }}</h6>
    <p class="card-text">Ck Trafik 1 Have open your wallet</p>
    <livewire:notification.read-at :notification="$notification" />
</div>

@endsection

