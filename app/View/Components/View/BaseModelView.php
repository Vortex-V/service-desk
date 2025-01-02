<?php

namespace App\View\Components\View;

use Arr;
use Generator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use ReflectionClass;
use ReflectionProperty;

abstract class BaseModelView extends Component
{
    public function __construct(
        public Collection|Model $data,
        public array            $settings,
        public ?string          $columnClass = Column::class,
    )
    {
    }

    abstract public function render(): View;

    /**
     * @throws \ReflectionException
     */
    public function columns(): Generator
    {
        foreach ($this->settings as $setting) {
            $class = $setting['class'] ?? $this->columnClass;
            $reflect = new ReflectionClass($class);
            $attributes = array_map(fn(ReflectionProperty $prop)=>$prop->getName(), $reflect->getProperties(ReflectionProperty::IS_PUBLIC));
            $settings = Arr::only($setting, $attributes);
            yield app($class, array_merge($settings, [
                'data' => $this->data,
            ]));
        }
    }
}
