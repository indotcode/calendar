<?php

namespace Indotcode\Calendar\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Indotcode\Calendar\App\Data;

class CalendarController extends Controller
{
    public function ajax(Request $request, $name)
    {
        $data = array();
        $calendar = new Data([
            'year' => $request->post('year'),
            'months' => $request->post('months')
        ]);
        switch ($name){
            case 'view':
                $data['calendar'] = $calendar->get();
                echo view('calendar::item', $data);
                break;
            case 'params':
                $result = $calendar->get();
                $data['navigation'] = $result->navigation;
                $data['current_year'] = $result->config['year'];
                $data['current_months'] = $result->monthsWeek[$result->config['months']]['name'];
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
                break;
        }
    }
}
