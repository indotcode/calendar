<?php
namespace Indotcode\Calendar;

use Indotcode\Calendar\Abstracts\Items;
use Indotcode\Calendar\App\Data;

class View
{
    public static function get($option = [])
    {
        $calendar = new Data($option);
        Items::elements($calendar, $option);
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
