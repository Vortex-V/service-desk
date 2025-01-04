<?php

declare(strict_types=1);

namespace App\View\Components\ModelView\Columns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

final class ActionColumn implements Column
{
    public function __construct(
        public array|Model   $data,
        public array|Closure $action,
    )
    {
    }

    /**
     * @throws \Throwable
     */
    public function getValue(): string
    {
        $result = call_user_func($this->action, $this->data);
        if ($result instanceof View) {
            return $result->render();
        }
        return $result;
    }
}
