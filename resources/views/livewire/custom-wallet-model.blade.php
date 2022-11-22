<div style="display: contents;">
<div id="wallet-box" class="col-xl-3 col-md-6 mb-4"  data-target="#Bank" data-toggle="modal">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Balance (Creadit)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $agent->bank->balance}}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                
                    <label class="my-2" for="balance">@if($typeSelected != null) New @endif Balance</label>
                    <input type="number" readonly class="form-control" id="balance" name="balance"
                    @if($typeSelected != null && $typeSelected == 'Deposit')
                    value="{{ is_numeric($amount) ? $amount + $agent->bank->balance : $agent->bank->balance }}"
                    @elseif($typeSelected != null && $typeSelected == 'Withdraw')
                    value="{{ is_numeric($amount) ? - $amount + $agent->bank->balance : $agent->bank->balance }}"
                    @else
                    value="{{ $agent->bank->balance }}"
                    @endif
                         />
                <label class="my-2" for="balance">Balance Type</label>
                    <select wire:model="typeSelected"  class="form-control">
                        <option value="">Balance Type</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}">{{ $type}}</option>
                        @endforeach
                    </select>

                    <label class="my-2" for="balance">Amount</label>
                    <input type="number" wire:model="amount" @if($typeSelected == null) readonly @endif class="form-control" id="balance" name="balance" value="{{ $amount}}" />

                   
                    <div class="onoffswitch4">
                        <input  type="checkbox"  name="onoffswitch4" class="onoffswitch4-checkbox" id="myonoffswitch4" @if(is_null($agent->bank->closed_at)) checked @endif>
                        <label class="onoffswitch4-label" for="myonoffswitch4">
                            <span class="onoffswitch4-inner"></span>
                            <span class="onoffswitch4-switch"></span>
                        </label>
                        </div>

            </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close X</button>
        <button wire:click="save({{$agent->bank->id}})" @if($typeSelected == null) disabled @endif class="btn btn-primary">Save Changes</button>
        </div>
    </div>
    </div>
</div>
</div>