<?php

declare(strict_types=1);

namespace App\Interface;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ModelSearch {
    public function search(): LengthAwarePaginator;
}
