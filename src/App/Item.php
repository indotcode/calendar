<?php

namespace Indotcode\Calendar\App;

use Illuminate\View\View;
use Indotcode\Calendar\App\Interfaces\ItemInterface;

class Item implements ItemInterface
{
    private $default_view = 'calendar::event.item';

    private $item_view;

    private $params = [];

    public function __construct(array $params, Data $data)
    {
        $this->params = $params;
        $this->item_view = $data->getItemView() === '' ? $this->default_view : $data->getItemView();
    }

    public function getDate() : string
    {
        return $this->params['date'];
    }

    public function getParams(string $key)
    {
        if(empty($this->params['params']) || count($this->params['params']) === 0){
            return '';
        } else {
            return $this->params['params'][$key];
        }
    }

    public function getTitle() : string
    {
        return $this->params['title'];
    }

    public function getColor() : string
    {
        if(empty($this->params['color']) || $this->params['color'] === '') {
            return 'white';
        } else {
            return $this->params['color'];
        }
    }

    public function getView() : View
    {
        if(empty($this->params['view']) || $this->params['view'] === '') return view($this->item_view, ['item' => $this]);
        return view($this->params['view'], ['item' => $this]);
    }
}
