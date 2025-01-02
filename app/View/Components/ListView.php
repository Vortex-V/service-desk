<?php

namespace App\View\Components;

use App\View\Components\View\BaseModelView;
use App\View\Components\View\Column;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ListView extends BaseModelView
{
    public const string COLUMN_VIEW_HORIZONTAL = 'horizontal';
    public const string COLUMN_VIEW_VERTICAL = 'vertical';

    public function __construct(
        Model|Collection $data,
        array            $settings,
        ?string          $columnClass = Column::class,
        public string    $columnView = self::COLUMN_VIEW_HORIZONTAL
    ) {
        parent::__construct($data, $settings, $columnClass);
    }

    public function render(): View
    {
        return view('components.model-view.list.view');
    }

    public function columnViewName(): string
    {
        return "model-view.list.item.$this->columnView";
    }
}
