<div class="calendar__navigation">
    <div class="calendar__navigation-prev" data-year="{{$navigation['prev']['year']}}" data-months="{{$navigation['prev']['months']}}">
        <svg width="10" height="8" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 5L5 1L9 5" stroke="#BDBDBD" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>
    <div></div>
    <div class="calendar__navigation-date">
        <div class="calendar__navigation-date-year">{{$navigation['months_name']}}</div>
        <div class="calendar__navigation-date-months">{{$navigation['year']}}</div>
    </div>
    <div></div>
    <div class="calendar__navigation-next" data-year="{{$navigation['next']['year']}}" data-months="{{$navigation['next']['months']}}">
        <svg width="10" height="8" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 5L5 1L9 5" stroke="#BDBDBD" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>
</div>
