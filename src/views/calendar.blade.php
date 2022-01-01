<div class="calendar">
    {{$calendar->getNavigationView()}}
    <div class="calendar__mounts">
        @include('calendar::item', ['calendar' => $calendar])
    </div>
</div>
