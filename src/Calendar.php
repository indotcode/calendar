<?php
namespace Indotcode\Calendar;

use Indotcode\Calendar\App\Data;

class Calendar
{
    public static function view($option = [])
    {
        $calendar = new Data($option);
        $data['calendar'] = $calendar->get();
        return view('calendar::calendar', $data);
    }

    public static function css($option = [])
    {
        return view('calendar::css', $option);
    }

    public static function js()
    {
        return view('calendar::js');
    }
}
