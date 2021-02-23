<link rel="stylesheet" type="text/css" href="{{ asset('calendar/css/style.css') }}" />
@if(!empty($font_family) && $font_family !== '')
    <style type="text/css">
        .calendar{
            font-family: {{$font_family}}, sans-serif;
        }
    </style>
@endif
