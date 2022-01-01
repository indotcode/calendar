@if(count($item) !== 0)
    <div class="calendar-event">
        @foreach($item as $val)
            {{$val->getView()}}
        @endforeach
    </div>
@endif
