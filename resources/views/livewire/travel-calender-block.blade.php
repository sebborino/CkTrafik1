
    <a href="
        @if(isset($travel))
            {{ route('admin.travel.edit', ['date' => $startOfCalendar, 'id' => $travel->id])}}" class="day {{$extraClass}}
        @else
            {{ route('admin.travel.store', ['date' => $startOfCalendar->format('d-m-Y'), 'id' => $destination->id])}}" class="day {{$extraClass}}
        @endif
            ">
        <div class="calender-box text-center pt-3">                              
            <i class="fas fa-plane" style="font-size:40px"></i>
            <h6>{{ $travel->destination->from->IATA}} - 
                @if(isset($travel->stopover_id))
                {{ $travel->stopover->IATA}}
                - 
                @endif
                {{ $travel->destination->to->IATA}}</h6>
        </div>
        <span class="content">{{ $startOfDate }} </span>
    </a>
    {{ $addDay }}
