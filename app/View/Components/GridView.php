<?php

namespace App\View\Components;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GridView extends Component
{
    public function __construct(
        public CursorPaginator $data
    )
    {}

    public function render(): View
    {
        // TODO
        return view('components.model-view.grid.grid-view');
    }
}
