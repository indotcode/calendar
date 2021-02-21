<?php
namespace Indotcode\Calendar;

use Indotcode\Calendar\Interfaces\CalendarInterface;

class Calendar implements CalendarInterface
{
    public $item = [];

    public $config = [
        'show_elapsed_date' => 1,
        'year' => '1990',
        'months' => '01'
    ];

    public $startDateYear;

    public $stopDateYear;

    public $currentDate;

    public $navigation = ['prev' => [], 'next' => []];

    public $dayWeek = [
        [
            'id' => 0,
            'name' => 'Понедельник',
            'slug' => 'Пн'
        ],
        [
            'id' => 1,
            'name' => 'Вторник',
            'slug' => 'Вт'
        ],
        [
            'id' => 2,
            'name' => 'Среда',
            'slug' => 'Ср'
        ],
        [
            'id' => 3,
            'name' => 'Четверг',
            'slug' => 'Чт'
        ],
        [
            'id' => 4,
            'name' => 'Пятница',
            'slug' => 'Пн'
        ],
        [
            'id' => 5,
            'name' => 'Суббота',
            'slug' => 'Сб'
        ],
        [
            'id' => 6,
            'name' => 'Воскресенье',
            'slug' => 'Вс'
        ]
    ];

    public $monthsWeek = [
        '01' => [
            'name' => 'Январь'
        ],
        '02' => [
            'name' => 'Февраль'
        ],
        '03' => [
            'name' => 'Март'
        ],
        '04' => [
            'name' => 'Апрель'
        ],
        '05' => [
            'name' => 'Май'
        ],
        '06' => [
            'name' => 'Июнь'
        ],
        '07' => [
            'name' => 'Июль'
        ],
        '08' => [
            'name' => 'Август'
        ],
        '09' => [
            'name' => 'Сентябрь'
        ],
        '10' => [
            'name' => 'Октябрь'
        ],
        '11' => [
            'name' => 'Ноябрь'
        ],
        '12' => [
            'name' => 'Декабрь'
        ]
    ];

    public $markup = [];

    public function __construct($config = [])
    {
        if(isset($config['show_elapsed_date'])){
            $this->config['show_elapsed_date'] = $config['show_elapsed_date'];
        }
        if(isset($config['year'])){
            $this->config['year'] = $config['year'];
        } else {
            $this->config['year'] = date("Y");
        }
        if(isset($config['months'])){
            $this->config['months'] = $config['months'];
        } else {
            $this->config['months'] = date("m");
        }
        $this->startDateYear = date($this->config['year']. "-".$this->config['months']."-01");
        $this->stopDateYear = date('Y-m-d', strtotime('+1 month - 1 day', strtotime($this->startDateYear)));
        $this->currentDate = date("Y-m-d");
        $this->__navigation();
    }

    private function __navigation()
    {
        $prev = explode("-", date('Y-m', strtotime('-15 day', strtotime($this->startDateYear))));
        $next = explode("-", date('Y-m', strtotime('+15 day', strtotime($this->stopDateYear))));
        $this->navigation = [
            'prev' => [
                'months' => $prev[1],
                'year' => $prev[0]
            ],
            'next' => [
                'months' => $next[1],
                'year' => $next[0]
            ]
        ];
    }

    public function get()
    {
        $dateYear = [];
        $date = $this->startDateYear;
        for($i = 0; $i < 33; $i++){
            if($i == 0){
                $dateYear[$i] = $this->startDateYear;
            } else {
                if(strtotime($date) == strtotime($this->stopDateYear)){
                    break;
                } else {
                    $date_tek = date('Y-m-d', strtotime('+1 day', strtotime($date)));
                    $dateYear[$i] = $date_tek;
                    $date = $date_tek;
                }
            }
        }

        foreach ($dateYear as $key => $val){
            $date_exp = explode("-", $val);
            $w = date("w", mktime(-24, 0, 0, $date_exp[1], $date_exp[0], $date_exp[2]));
            $var_result = [];
            $var_result['date'] = $val;
            $var_result['date_exp'] = $date_exp;
            $var_result['type'] = 'acting';
            $var_result['dayWeek'] = $this->dayWeek[$w];
            $var_result['current'] = ($val ==  $this->currentDate ? "Y" : "N");
            $var_result['item'] = $this->_itemAndMarkup($val);
            $this->markup[$key] = $var_result;
        }
        $this->_tableCell();
        return $this;
    }

    public function item($date, $params = [])
    {
        if($this->config['show_elapsed_date'] == 0 && strtotime($date) < strtotime($this->currentDate)){
            return $this;
        }
        $this->item[$date][] = $params;
        return $this;
    }

    private function _tableCell()
    {
        $resultAr = [];
        $day = $this->markup[0]['dayWeek']['id'] + 1;
        $date_preend = $this->markup[0]['date'];
        $preend = [];
        $day_none = $day - 1;
        $d = $day_none;
        for ($i = 0; $i < $day_none; $i++){
            $date_prev = date('Y-m-d', strtotime('-'.$d.' day', strtotime($date_preend)));
            $date_prev_ex = explode("-", $date_prev);
            $date_prev_ex_w = date("w", mktime(-24, 0, 0, $date_prev_ex[1], $date_prev_ex[2], $date_prev_ex[0]));
            $prev = [];
            $prev['date'] = $date_prev;
            $prev['date_exp'] = $date_prev_ex;
            $prev['type'] = 'past';
            $prev['dayWeek'] = $this->dayWeek[$date_prev_ex_w];
            $prev['current'] = ($date_prev ==  $this->currentDate ? "Y" : "N");
            $prev['item'] = $this->_itemAndMarkup($date_prev);
            $preend[] = $prev;
            $d--;
        }
        foreach ($this->markup as $key => $val){
            $resultAr[] = $val;
        }

        $resultAr = array_merge($preend, $resultAr);
        $resultAr = array_chunk($resultAr, 7);

        $resultRs = [];
        foreach ($resultAr as $key => $val){
            if(count($val) != 7){
                $day_none_append = 7 - count($val);
                $append = [];
                $date_append = end($val)['date'];
                for($i = 0; $i < $day_none_append; $i++){
                    $date_next = date('Y-m-d', strtotime('+'.($i+1).' day', strtotime($date_append)));
                    $date_next_ex = explode("-", $date_next);
                    $date_next_ex_w = date("w", mktime(-24, 0, 0, $date_next_ex[1], $date_next_ex[2], $date_next_ex[0]));
                    $next = [];
                    $next['date'] = $date_next;
                    $next['date_exp'] = $date_next_ex;
                    $next['type'] = 'past';
                    $next['dayWeek'] = $this->dayWeek[$date_next_ex_w];
                    $next['current'] = ($date_next ==  $this->currentDate ? "Y" : "N");
                    $next['item'] = $this->_itemAndMarkup($date_next);
                    $append[] = $next;
                }

                $resultRs[] = array_merge($val, $append);
            } else {
                $resultRs[] = $val;
            }
        }
        $this->markup = $resultRs;
    }

    private function _itemAndMarkup($date)
    {
        $result = [];
        if(!empty($this->item[$date])){
            $result = $this->item[$date];
        }
        return $result;
    }
}
