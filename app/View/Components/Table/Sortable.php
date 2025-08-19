<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sortable extends Component
{
    public string $label;
    public string $column;
    public string $sortCol;
    public string $dir;
    public string $wireClick;
    public function __construct($label, $column, $sortCol, $dir, $wireClick)
    {
        $this->label = $label;
        $this->column = $column;
        $this->sortCol = $sortCol;
        $this->dir = $dir;
        $this->wireClick = $wireClick;
    }

    public function render(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|Closure|string|\Illuminate\View\View
    {
        return view('components.table.sortable');
    }
}
