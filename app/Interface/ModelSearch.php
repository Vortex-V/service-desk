<?php

declare(strict_types=1);

namespace App\Interface;

use Illuminate\Contracts\Pagination\CursorPaginator;

interface ModelSearch {
    public function search(): CursorPaginator;
}
