<?php
namespace Indotcode\Calendar\Abstracts;

abstract class Items
{
    private static $default_view = 'calendar::listItem';

    public static function elements($calendar, $option)
    {
        if(!empty($option['elements']) && count($option['elements']) !== 0){
            foreach ($option['elements'] as $key => $val){
                foreach ($val['items'] as $key_items => $val_items){
                    $calendar->item($val['date'], self::view($val), $val_items);
                }
            }
        }
    }

    private static function view($val)
    {
        if(empty($val['views']) || $val['views'] === ''){
            $view = self::$default_view;
        } else {
            $view = $val['views'];
        }
        return $view;
    }
}
