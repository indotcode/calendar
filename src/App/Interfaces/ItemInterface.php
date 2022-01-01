<?php

namespace Indotcode\Calendar\App\Interfaces;

use Illuminate\View\View;

interface ItemInterface
{
    public function getDate() : string;

    public function getParams(string $key);

    public function getTitle() : string;

    public function getColor() : string;

    public function getView() : View;
}
