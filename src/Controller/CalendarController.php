<?php

namespace Indotcode\Calendar\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Indotcode\Calendar\Abstracts\Items;
use Indotcode\Calendar\App\Data;

class CalendarController extends Controller
{
    public function ajax(Request $request, $name)
    {
        $data = array();
        $option = \GuzzleHttp\json_decode($request->post('option'), true);
        $option = (array)$option;

        $option['year'] = $request->post('year');
        $option['months'] = $request->post('months');
        $calendar = new Data($option);
//        Items::elements($calendar, $option);
//        print_r($option);
        switch ($name){
            case 'view':
                Items::elements($calendar, $option);
                $data['calendar'] = $calendar->get();
                echo view('calendar::item', $data);
                break;
            case 'params':
                $result = $calendar->get();
                $data['navigation'] = $result->navigation;
                $data['current_year'] = $result->config['year'];
                $data['current_months'] = $result->monthsWeek[$result->config['months']]['name'];
                echo \GuzzleHttp\json_encode($data);
                break;
        }
    }
}
