<div>
    <div class="form-check">
        <input wire:click="toggle_term" type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Accept Term</label>
        
    </div>
    <button wire:click="accept" @if($term == false) disabled @endif class="btn btn-primary">Accept</button>
</div>