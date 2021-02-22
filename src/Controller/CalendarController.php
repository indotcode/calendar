<?php

namespace Indotcode\Calendar\Controller;

use Illuminate\Http\Client\Request;
use Illuminate\Routing\Controller;

class CalendarController extends Controller
{
    public function ajax(Request $request, $name)
    {
        print_r(123);
    }
}
