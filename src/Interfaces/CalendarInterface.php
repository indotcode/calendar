<?php
namespace Indotcode\Calendar\Interfaces;

interface CalendarInterface
{
    public function __construct($config = []);

    public function get();

    public function item($date, $params);
}
