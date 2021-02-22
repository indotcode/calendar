<?php
namespace Indotcode\Calendar\Abstracts;

abstract class Items
{
    public static function elements($calendar, $elements)
    {
        if(!empty($elements) && count($elements) !== 0){
            foreach ($elements as $key => $val){
                foreach ($val['items'] as $key_items => $val_items){
                    $calendar->item($val['date'], $val['views'], $val_items);
                }
            }
        }
    }
}
