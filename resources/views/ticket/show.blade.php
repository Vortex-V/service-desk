@php
    declare(strict_types=1)
@endphp

@php
    $title = "Заявка {$ticket->id}";
    $user = auth()->user();
@endphp

<x-layout.app :title="$title">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm mb-2">
                    <div class="card-body">
                        <h1>{{ $title }}</h1>

                        <x-list-view
                            :data="$ticket"
                            :settings="[
                                [
                                    'attribute' => 'type.title',
                                    'label' => 'Тип',
                                ],
                                [
                                    'attribute' => 'priority.title',
                                    'label' => 'Приоритет',
                                ],
                                [
                                    'attribute' => 'status',
                                    'value' => [\App\Models\Ticket\Ticket::class, 'getStatusLabel'],
                                    'label' => 'Статус',
                                ],
                                [
                                    'attribute' => 'author.fullName',
                                    'label' => 'Автор',
                                ],
                               [
                                    'attribute' => 'manager.fullName',
                                    'label' => 'Менеджер',
                                ],
                            ]"
                        />
                    </div>
                </div>
            </div>
            <div class="col-md-5 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <x-list-view
                            :data="$ticket"
                            :settings="[
                                [
                                    'attribute' => 'applicant.fullName',
                                    'label' => 'Заявка от',
                                ],
                                [
                                    'attribute' => 'description',
                                    'label' => 'Описание',
                                ],
                            ]"
                            :column-view="\App\View\Components\ListView::COLUMN_VIEW_VERTICAL"
                        />
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
