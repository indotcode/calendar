<?php
namespace Indotcode\Calendar;

use Indotcode\Calendar\Abstracts\Items;
use Indotcode\Calendar\App\Data;

class View
{
    private static $option = '';

    public static function get($option = [])
    {
        $calendar = new Data($option);
        Items::elements($calendar, $option);
        self::$option = \GuzzleHttp\json_encode($option);
        $data['calendar'] = $calendar->get();
        return view('calendar::calendar', $data);
    }

    public static function css($option = [])
    {
        return view('calendar::css', $option);
    }

    public static function js()
    {
        $data = [];
        $data['option'] = self::$option;
        return view('calendar::js', $data);
    }
}
