<?php
namespace Indotcode\Calendar\App;

use Illuminate\View\View;
use Indotcode\Calendar\App\Interfaces\DataInterface;

class Data implements DataInterface
{
    protected $config = [
        'year' => '1990',
        'months' => 1
    ];

    protected $dayWeek = [
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

    protected $monthsWeek = [
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

    protected $startDateYear;

    protected $stopDateYear;

    protected $currentDate;

    protected $navigation = ['prev' => [], 'next' => []];

    protected $markup = [];

    public function getMarkup() : array
    {
        return $this->markup;
    }

    public function getDayWeek(): array
    {
        return $this->dayWeek;
    }

    public function getDayWeekKey($key): array
    {
        return $this->dayWeek[$key];
    }

    public function getMonthsWeek(): array
    {
        return $this->monthsWeek;
    }

    public function getMonthsWeekId(int $id): array
    {
        if($id < 1 || $id > 12) return $this->getMonthsWeek()['12'];
        $key = "0";
        if($id < 10) {
            $key = $key . $id;
        } else {
            $key = (string) $id;
        }
        return $this->getMonthsWeek()[$key];
    }

    public function setConfig($config = []): Data
    {
        $config['year'] = $config['year'] ?? date("Y");
        $config['months'] = $config['months'] ?? date("m");
        $config['visible_current_date'] = $config['visible_current_date'] ?? true;
        $config['display_navigation'] = $config['display_navigation'] ?? true;
        $config['item'] = $config['item'] ?? [];
        $config['item_view'] = $config['item_view'] ?? '';
        $this->config = $config;
        return $this;
    }

    public function getItemView() : string
    {
        return $this->getConfigKey('item_view');
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function getConfigJson(): string
    {
        return \GuzzleHttp\json_encode($this->getConfig());
    }

    public function getConfigKey(string $key)
    {
        return $this->getConfig()[$key];
    }

    private function navigationStructure()
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
            ],
        ];
        $this->navigation['months_name'] = $this->getMonthsWeekId($this->getConfigKey('months'))['name'];
        $this->navigation['year'] = $this->getConfigKey('year');
    }

    public function getNavigationView() : View
    {
        if($this->getConfigKey('display_navigation')){
            return view('calendar::navigation', ['navigation' => $this->navigation]);
        }
        return view('calendar::none');
    }

    public function getNavigation(): array
    {
        return $this->navigation;
    }

    private function startStopDate()
    {
        $this->startDateYear = date($this->getConfigKey('year'). "-" . $this->getConfigKey('months') . "-01");
        $this->stopDateYear = date('Y-m-d', strtotime('+1 month - 1 day', strtotime($this->startDateYear)));
    }

    public function get(): Data
    {
        $this->startStopDate();
        $this->navigationStructure();
        $this->markupStructure();
        return $this;
    }

    private function markupStructure(){
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
            $var_result['dayWeek'] = $this->getDayWeekKey($w);
            $var_result['current'] = $this->visibleCurrentDate($val);
            $var_result['item'] = $this->itemAndMarkup($val);
            $this->markup[$key] = $var_result;
        }

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
            $prev['dayWeek'] = $this->getDayWeekKey($date_prev_ex_w);
            $prev['current'] = $this->visibleCurrentDate($date_prev);
            $prev['item'] = $this->itemAndMarkup($date_prev);
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
                    $next['dayWeek'] = $this->getDayWeekKey($date_next_ex_w);
                    $next['current'] = $this->visibleCurrentDate($date_next);
                    $next['item'] = $this->itemAndMarkup($date_next);
                    $append[] = $next;
                }

                $resultRs[] = array_merge($val, $append);
            } else {
                $resultRs[] = $val;
            }
        }
        $this->markup = $resultRs;
    }

    private function itemAndMarkup($date)
    {
        $item = $this->getConfigKey('item');
        if(count($item) == 0) return [];
        $result = [];
        foreach ($item as $param){
            if($param['date'] === $date){
                $result[] = new Item($param, $this);
            }
        }
        return $result;
    }

    public function getCurrentDate(){
        return $this->currentDate;
    }

    public function setCurrentDate($date = null) : Data
    {
        if(is_null($date)){
            $this->currentDate = date("Y-m-d");
        } else {
            $this->currentDate = $date;
        }
        return $this;
    }

    private function visibleCurrentDate($date): string
    {
        if(!$this->getConfigKey('visible_current_date')){
            return 'N';
        }
        return $date == $this->getCurrentDate() ? "Y" : "N";
    }
}
