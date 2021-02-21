<div class="calendar">
    <div class="calendar__navigation">
{{--        <div class="calendar__navigation-prev" data-year="{{$calendar->navigation['prev']['year']}}" data-months="{{$calendar->navigation['prev']['months']}}">--}}
{{--            <svg width="10" height="8" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                <path d="M1 5L5 1L9 5" stroke="#BDBDBD" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--            </svg>--}}
{{--        </div>--}}
        <div></div>
        <div class="calendar__navigation-date">
            <div class="calendar__navigation-date-year">{{$calendar->monthsWeek[$calendar->config['months']]['name']}}</div>
            <div class="calendar__navigation-date-months">{{$calendar->config['year']}}</div>
        </div>
        <div></div>
{{--        <div class="calendar__navigation-next" data-year="{{$calendar->navigation['next']['year']}}" data-months="{{$calendar->navigation['next']['months']}}">--}}
{{--            <svg width="10" height="8" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                <path d="M1 5L5 1L9 5" stroke="#BDBDBD" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--            </svg>--}}
{{--        </div>--}}
    </div>
    <div class="calendar__mounts">
        @include('calendar::item')
    </div>
</div>
