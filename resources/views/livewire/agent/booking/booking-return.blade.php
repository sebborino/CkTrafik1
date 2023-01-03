<div>
    <div class="form-group">
        <div class="col-md-2 offset-md-5">
            <label for="travelType">One Way/Return</label>
            <select class="form-control" wire:model="type">
                @forelse($travelTypes as $travelType)
                    <option value="{{$travelType->id}}">{{$travelType->name}}</option>
                @empty    
                @endforelse
            </select>
            <input type="hidden" name="class_type" value="{{$type}}">
        </div>
    </div>
    <div class="form-group row" style="@if($type == 1) opacity:0 @elseif($type == 2) opacity:100 @endif">
        <livewire:agent.booking.booking-airport-input :name="'return_from'" :title="'Return From'" />
        <livewire:agent.booking.booking-airport-input :name="'return_to'" :title="'Return To'" />
        <livewire:agent.booking.booking-calender :name="'return_date'" :title="'Return Date'"/>
    </div>
</div>