<?php

declare(strict_types=1);

namespace App\View\Components\ModelView\Columns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DataColumn implements Column {
    public function __construct(
        public array|Model                   $data,
        public string                        $attribute,
        public string|int|array|Closure|null $value = null,
        public string|null                   $label = null,
    )
    {
    }

    public function getLabel(): string
    {
        if (isset($this->label)) {
            return $this->label;
        }

        $label = Str::of($this->attribute)->snake()->explode('_')->join('_');
        return Str::apa($label);
    }

    public function getValue(): string
    {
        $attribute = explode('.', $this->attribute);
        if ($this->data instanceof Model && count($attribute) > 1) {
            $relation = array_shift($attribute);
            $value = $this->data->$relation;
            if ($value instanceof Model) {
                return (new static($value, join('.', $attribute), $this->value))->getValue();
            }
            return (string) ($value ?? '-');
        }
        $attribute = reset($attribute);

        if (is_null($this->value)) {
            $value = $this->data[$attribute];
        } else {
            $value = $this->value;
        }

        switch ($value) {
            case is_scalar($value): return (string)$value;
            case is_callable($value): return $value($this->data);
            default: return '-';
        }
    }
}
