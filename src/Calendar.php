<?php
namespace Indotcode\Calendar;

use Indotcode\Calendar\App\Data;

class Calendar
{
    public static function view($option = [])
    {
        $calendar = new Data($option);
        $data['calendar'] = $calendar->get();
        dump($data);
        return view('calendar::calendar', $data);
    }

    public static function css()
    {
        return view('calendar::css');
    }

    public static function js()
    {
        return view('calendar::css');
    }
}
