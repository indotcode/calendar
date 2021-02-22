<link rel="stylesheet" type="text/css" href="{{ asset('calendar/style.css') }}" />
@if(!empty($font_family) && $font_family !== '')
    <style type="text/css">
        .calendar{
            font-family: {{$font_family}}, sans-serif;
        }
    </style>
@endif
