<div class="calendar__dayWeek">
    @foreach($calendar->getDayWeek() as $val_dayWeek)
        <div class="calendar__dayWeek-cell">
            <span class="calendar__dayWeek-cell-full">{{$val_dayWeek['name']}}</span>
            <span class="calendar__dayWeek-cell-mini">{{$val_dayWeek['slug']}}</span>
        </div>
    @endforeach
</div>
@foreach($calendar->getMarkup() as $key => $val)
    <div class="calendar__days">
        @foreach($val as $key_day => $val_day)
            <div class="calendar__days-cell{{count($val_day['item']) != 0 ? ' calendar__days-cell--green' : ''}}">
                <div class="calendar-item {{$val_day['type'] == 'past' ? 'calendar-item--disable' : ''}}">
                    <div class="calendar-item__day {{$val_day['current'] == 'Y' ? 'calendar-item__day--current' : ''}}">{{$val_day['date_exp'][2]}}</div>
                    @include('calendar::event.list', ['item' => $val_day['item']])
                </div>
            </div>
        @endforeach
    </div>
@endforeach
