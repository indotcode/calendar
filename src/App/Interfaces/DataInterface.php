<?php

namespace Indotcode\Calendar\App\Interfaces;

use Indotcode\Calendar\App\Data;
use Indotcode\Calendar\App\Resourse;

interface DataInterface
{
    public function getMarkup() : array;

    public function getDayWeek() : array;

    public function getMonthsWeek() : array;

    public function getMonthsWeekKey(string $key) : array;

    public function setConfig() : Data;

    public function getConfig() : array;

    public function getConfigJson() : string;

    public function getConfigKey(string $key) : string;

    public function get() : Data;

    public function getNavigation() : array;

    public function setCurrentDate(string $date) : Data;
}
