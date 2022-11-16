
    <a href="{{ route('admin.travel.store', ['date' => $startOfCalendar->format('d-m-Y'), 'id' => $destination->id])}}" class="day {{$extraClass}}">
        <div class="calender-box text-center pt-3">                              

        </div>
        <span class="content">{{ $startOfCalendar->format('d M') }} </span>
    </a>

