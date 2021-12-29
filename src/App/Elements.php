<?php

namespace Indotcode\Calendar\App;

use Indotcode\Calendar\Interfaces\CalendarInterface;

class Elements
{

    private static $default_view = 'calendar::listItem';

    public function __construct($calendar)
    {
        $this->elements($calendar);
    }

    private function elements($calendar)
    {
        $config = $calendar->get;
        if(!empty($config['elements']) && count($config['elements']) !== 0){
            foreach ($config['elements'] as $key => $val){
                foreach ($val['items'] as $key_item=> $val_item){
                    $this->item($val['date'], $this->view($val), $val_item);
                }
            }
        }
    }

    private function view($val)
    {
        if(empty($val['views']) || $val['views'] === ''){
            $view = self::$default_view;
        } else {
            $view = $val['views'];
        }
        return $view;
    }

    private function item($date, $views, $params = []): Data
    {
        if($this->config['show_elapsed_date'] == 0 && strtotime($date) < strtotime($this->currentDate)){
            return $this;
        }
        $this->item[$date][] = [
            'views' => $views,
            'params' => $params
        ];
        return $this;
    }
}
