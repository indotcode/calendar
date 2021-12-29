<?php
namespace Indotcode\Calendar;

use Indotcode\Calendar\App\Data;

class View
{
    /**
     * @var Data
     */
    private static $calendar;

    public static function get($config = [])
    {
        self::$calendar = new Data();
        $data = self::$calendar->setCurrentDate()->setConfig($config)->get();
//        dd($data);
        return view('calendar::calendar', ['calendar' => $data]);
    }

    public static function css($config = [])
    {
        return view('calendar::css', $config);
    }

    public static function js()
    {
        return view('calendar::js', ['option' => self::$calendar->getConfigJson()]);
    }
}
