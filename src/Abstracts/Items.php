<?php
namespace Indotcode\Calendar\Abstracts;

abstract class Items
{
    public static function elements($calendar, $option)
    {
        if(!empty($option['elements']) && count($option['elements']) !== 0){
            foreach ($option['elements'] as $key => $val){
                foreach ($val['items'] as $key_items => $val_items){
                    $calendar->item($val['date'], $val['views'], $val_items);
                }
            }
        }
    }
}
