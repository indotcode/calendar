<?php

namespace Indotcode\Calendar\App\Interfaces;

use Illuminate\View\View;
use Indotcode\Calendar\App\Data;

interface DataInterface
{
    public function getItemView() : string;

    public function getMarkup() : array;

    public function getDayWeek() : array;

    public function getDayWeekKey(string $key) : array;

    public function getMonthsWeek() : array;

    public function getMonthsWeekId(int $id) : array;

    public function setConfig() : Data;

    public function getConfig() : array;

    public function getConfigJson() : string;

    public function getConfigKey(string $key);

    public function get() : Data;

    public function getNavigation() : array;

    public function getNavigationView() : View;

    public function setCurrentDate(string $date) : Data;
}
